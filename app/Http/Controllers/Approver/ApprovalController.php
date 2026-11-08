<?php

namespace App\Http\Controllers\Approver;

use App\Http\Controllers\Controller;
use App\Models\ApprovalDelegation;
use App\Models\AuditLog;
use App\Models\TravelPolicy;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    protected function getActiveApprover(): User
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (! $user->isApprover()) {
                abort(403, 'Akses Ditolak: Anda tidak memiliki kewenangan sebagai Atasan / Approver.');
            }

            return $user;
        }

        return User::where('role', 'atasan')->first() ?? User::first();
    }

    /**
     * Display the Approver dashboard and pending queue.
     */
    public function index(Request $request)
    {
        $approver = $this->getActiveApprover();

        $query = TravelRequest::with(['user', 'approver']);

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('department') && $request->department !== 'all') {
            $dept = $request->department;
            $query->whereHas('user', function ($q) use ($dept) {
                $q->where('department', 'like', "%{$dept}%");
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('request_number', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhere('destination_city', 'like', "%{$search}%")
                    ->orWhereHas('user', fn ($uq) => $uq->where('name', 'like', "%{$search}%"));
            });
        }

        $requests = $query->orderByRaw("CASE WHEN status = 'pending_approval' THEN 0 ELSE 1 END")
            ->orderBy('start_date', 'asc')
            ->get();

        $activeDelegation = ApprovalDelegation::with('delegate')
            ->where('delegator_id', $approver->id)
            ->where('is_active', true)
            ->whereDate('end_date', '>=', now()->toDateString())
            ->first();

        $pendingCount = TravelRequest::where('status', 'pending_approval')->count();
        $approvedCount = TravelRequest::whereIn('status', ['approved', 'ticket_issued', 'completed'])->count();
        $approvedBudget = TravelRequest::whereIn('status', ['approved', 'ticket_issued', 'completed'])->sum('total_estimated_budget');
        $revisionCount = TravelRequest::where('status', 'revision_required')->count();

        $stats = [
            'pending' => $pendingCount,
            'pending_count' => $pendingCount,
            'approved' => $approvedCount,
            'approved_count' => $approvedCount,
            'approved_budget' => $approvedBudget,
            'committed_budget' => $approvedBudget,
            'revision' => $revisionCount,
            'revision_count' => $revisionCount,
            'active_delegation' => $activeDelegation,
        ];

        $recentDecisions = TravelRequest::with('user')
            ->whereIn('status', ['approved', 'ticket_issued', 'completed', 'revision_required', 'rejected'])
            ->orderByDesc('updated_at')
            ->take(5)
            ->get();
        $recentProcessed = $recentDecisions;

        return view('approver.index', compact('approver', 'requests', 'stats', 'activeDelegation', 'recentDecisions', 'recentProcessed'));
    }

    /**
     * Display a specific SPPD request for approval review and policy check.
     */
    public function show(string $id = 'TRQ-2023-0891')
    {
        $approver = $this->getActiveApprover();

        $trip = TravelRequest::with(['user', 'approver'])
            ->where(function ($q) use ($id) {
                $q->where('request_number', $id)->orWhere('id', $id);
            })
            ->first() ?? TravelRequest::with(['user', 'approver'])->firstOrFail();

        $requestId = $trip->request_number;
        $policy = TravelPolicy::forJobLevel($trip->user?->job_level);
        $nights = max(1, $trip->duration_days - 1);
        $nightlyHotelRate = $trip->hotel_cost / $nights;
        $isHotelOverLimit = $trip->user && $nightlyHotelRate > $trip->user->getHotelLimit();

        return view('approver.show', compact('trip', 'requestId', 'approver', 'policy', 'nightlyHotelRate', 'isHotelOverLimit'));
    }

    /**
     * Approve a travel request (supports multi-level approval & delegation tracking).
     */
    public function approve(Request $request, string $id)
    {
        $approver = $this->getActiveApprover();

        $trip = TravelRequest::with(['user', 'approver'])
            ->where(function ($q) use ($id) {
                $q->where('request_number', $id)->orWhere('id', $id);
            })
            ->firstOrFail();

        $notes = $request->input('approval_notes');

        // Check if acting as a proxy delegate
        $delegation = ApprovalDelegation::with('delegator')
            ->where('delegate_id', $approver->id)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now()->toDateString())
            ->whereDate('end_date', '>=', now()->toDateString())
            ->first();

        $proxyLabel = '';
        if ($delegation) {
            $delegation->increment('processed_count');
            $proxyLabel = " (Approved by Proxy on Behalf of {$delegation->delegator->name})";
        }

        // Multi-level approval check (TC-07)
        if ($trip->required_approval_level > $trip->current_approval_level) {
            $nextApproverId = $trip->user?->second_approver_id
                ?? $trip->approver?->manager_id
                ?? User::where('job_level', 'Direktur')->value('id')
                ?? $approver->id;

            $trip->update([
                'current_approval_level' => $trip->current_approval_level + 1,
                'approver_id' => $nextApproverId,
                'approval_notes' => $notes,
                'status' => 'pending_approval',
            ]);

            AuditLog::record(
                'APPROVE_SPPD_LVL1',
                "Persetujuan Level 1 SPPD {$trip->request_number} oleh {$approver->name}{$proxyLabel}; diteruskan ke Level 2 (Direktur).",
                $trip->request_number,
                $approver
            );

            return redirect()->route('approver.requests')
                ->with('success', "Persetujuan Level 1 untuk {$trip->request_number} berhasil dicatat dan diteruskan ke Approver Level 2.");
        }

        $trip->update([
            'status' => 'approved',
            'approval_date' => now(),
            'approver_id' => $approver->id,
            'approval_notes' => $notes,
            'revision_notes' => null,
            'rejection_reason' => null,
        ]);

        AuditLog::record(
            'APPROVE_SPPD',
            "Menyetujui final SPPD {$trip->request_number} ({$trip->user->name} · Rp ".number_format($trip->total_estimated_budget, 0, ',', '.')."){$proxyLabel}",
            $trip->request_number,
            $approver
        );

        return redirect()->route('approver.requests')
            ->with('success', "Pengajuan SPPD {$trip->request_number} resmi disetujui dan diteruskan ke Travel Desk & Keuangan!");
    }

    /**
     * Request revision on a travel request (TC-05).
     */
    public function revision(Request $request, string $id)
    {
        $approver = $this->getActiveApprover();

        if ($request->filled('revision_note') && ! $request->filled('revision_notes')) {
            $request->merge(['revision_notes' => $request->input('revision_note')]);
        }

        $validated = $request->validate([
            'revision_notes' => 'required|string|min:5|max:1000',
        ]);

        $trip = TravelRequest::with('user')
            ->where(function ($q) use ($id) {
                $q->where('request_number', $id)->orWhere('id', $id);
            })
            ->firstOrFail();

        $trip->update([
            'status' => 'revision_required',
            'revision_notes' => $validated['revision_notes'],
            'approver_id' => $approver->id,
        ]);

        AuditLog::record(
            'REVISE_SPPD',
            "Meminta revisi SPPD {$trip->request_number}: {$validated['revision_notes']}",
            $trip->request_number,
            $approver
        );

        return redirect()->route('approver.dashboard')
            ->with('success', "Permintaan revisi untuk SPPD {$trip->request_number} telah dikirim ke pemohon.");
    }

    /**
     * Reject a travel request (TC-06).
     */
    public function reject(Request $request, string $id)
    {
        $approver = $this->getActiveApprover();

        $validated = $request->validate([
            'rejection_reason' => 'required|string|min:5|max:1000',
        ]);

        $trip = TravelRequest::with('user')
            ->where(function ($q) use ($id) {
                $q->where('request_number', $id)->orWhere('id', $id);
            })
            ->firstOrFail();

        $trip->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
            'approver_id' => $approver->id,
        ]);

        AuditLog::record(
            'REJECT_SPPD',
            "Menolak SPPD {$trip->request_number}: {$validated['rejection_reason']}",
            $trip->request_number,
            $approver
        );

        return redirect()->route('approver.dashboard')
            ->with('success', "Pengajuan SPPD {$trip->request_number} telah ditolak.");
    }

    /**
     * Display approval delegation management view.
     */
    public function delegation()
    {
        $approver = $this->getActiveApprover();

        $activeDelegation = ApprovalDelegation::with('delegate')
            ->where('delegator_id', $approver->id)
            ->where('is_active', true)
            ->first();

        $delegations = ApprovalDelegation::with('delegate')
            ->where('delegator_id', $approver->id)
            ->orderByDesc('start_date')
            ->get();

        $peerManagers = User::where('id', '!=', $approver->id)
            ->whereIn('role', ['atasan', 'approver', 'admin'])
            ->get();
        $colleagues = $peerManagers;

        return view('approver.delegation', compact('approver', 'activeDelegation', 'delegations', 'peerManagers', 'colleagues'));
    }

    /**
     * Store a new approval delegation (TC-08).
     */
    public function storeDelegation(Request $request)
    {
        $approver = $this->getActiveApprover();

        $validated = $request->validate([
            'delegate_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:500',
        ]);

        ApprovalDelegation::where('delegator_id', $approver->id)->update(['is_active' => false]);

        $delegation = ApprovalDelegation::create([
            'delegator_id' => $approver->id,
            'delegate_id' => $validated['delegate_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'reason' => $validated['reason'],
            'notify_hr' => $request->boolean('notify_hr', true),
            'is_active' => true,
        ]);

        $delegateUser = User::find($validated['delegate_id']);

        AuditLog::record(
            'DELEGATE_APPROVAL',
            "Mengaktifkan delegasi wewenang persetujuan kepada {$delegateUser?->name} ({$validated['start_date']} s/d {$validated['end_date']})",
            "DEL-{$delegation->id}",
            $approver
        );

        return redirect()->route('approver.delegation')
            ->with('success', "Delegasi wewenang persetujuan kepada {$delegateUser?->name} berhasil diaktifkan!");
    }

    /**
     * Deactivate an active delegation.
     */
    public function deactivateDelegation(int $id)
    {
        $approver = $this->getActiveApprover();

        $delegation = ApprovalDelegation::where('id', $id)
            ->where('delegator_id', $approver->id)
            ->firstOrFail();

        $delegation->update(['is_active' => false]);

        AuditLog::record(
            'REVOKE_DELEGATION',
            'Menonaktifkan delegasi wewenang persetujuan dan kembali ke mode review langsung.',
            "DEL-{$delegation->id}",
            $approver
        );

        return redirect()->route('approver.delegation')
            ->with('success', 'Delegasi wewenang telah dinonaktifkan.');
    }
}
