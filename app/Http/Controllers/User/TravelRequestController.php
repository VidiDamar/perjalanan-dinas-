<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ApprovalDelegation;
use App\Models\AuditLog;
use App\Models\TravelPolicy;
use App\Models\TravelRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TravelRequestController extends Controller
{
    /**
     * Get active logged-in user or demo fallback
     */
    protected function getActiveUser(): User
    {
        return Auth::user() ?? User::where('role', 'user')->first() ?? User::first();
    }

    /**
     * Display a listing of user's travel requests with search & status filters.
     */
    public function index(Request $request)
    {
        $user = $this->getActiveUser();

        $query = TravelRequest::where('user_id', $user->id);

        if ($request->filled('status') && $request->status !== 'Semua Status') {
            $statusMap = [
                'Disetujui' => 'approved',
                'Menunggu Review' => 'pending_approval',
                'Perlu Revisi' => 'revision_required',
                'Draf' => 'draft',
                'Selesai' => 'completed',
                'Ditolak' => 'rejected',
                'Tiket Terbit' => 'ticket_issued',
            ];
            $dbStatus = $statusMap[$request->status] ?? $request->status;
            $query->where('status', $dbStatus);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('request_number', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhere('destination_city', 'like', "%{$search}%");
            });
        }

        $requests = $query->orderByDesc('id')->paginate(10)->withQueryString();

        $stats = [
            'total' => TravelRequest::where('user_id', $user->id)->count(),
            'approved' => TravelRequest::where('user_id', $user->id)->whereIn('status', ['approved', 'ticket_issued'])->count(),
            'pending' => TravelRequest::where('user_id', $user->id)->where('status', 'pending_approval')->count(),
            'revision' => TravelRequest::where('user_id', $user->id)->where('status', 'revision_required')->count(),
        ];

        return view('requests.index', compact('requests', 'stats', 'user'));
    }

    /**
     * Show form for creating a new travel request.
     */
    public function create()
    {
        $user = $this->getActiveUser();

        return view('requests.create', compact('user'));
    }

    /**
     * Store newly created travel request into database.
     */
    public function store(Request $request)
    {
        $user = $this->getActiveUser();
        $policy = TravelPolicy::forJobLevel($user->job_level);

        $docRule = $request->boolean('require_document')
            ? 'required|file|mimes:pdf,jpg,jpeg,png|max:10240'
            : 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240';

        $validated = $request->validate([
            'purpose' => 'required|string|max:255',
            'origin_city' => 'required|string|max:100',
            'destination_city' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'transport_mode' => 'required|string',
            'flight_hotel_preference' => 'nullable|string|max:500',
            'estimated_transport' => 'nullable|numeric|min:0',
            'estimated_hotel' => 'nullable|numeric|min:0',
            'estimated_per_diem' => 'nullable|numeric|min:0',
            'estimated_other' => 'nullable|numeric|min:0',
            'cash_advance_requested' => 'nullable|numeric|min:0',
            'out_of_policy_reason' => 'nullable|string|max:500',
            'document' => $docRule,
        ]);

        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);
        $durationDays = max(1, $start->diffInDays($end) + 1);

        $dailyPerDiemLimit = $user->getDailyPerDiemLimit();
        $perDiem = ($validated['estimated_per_diem'] ?? null) ?: ($dailyPerDiemLimit * $durationDays);
        $transport = $validated['estimated_transport'] ?? 0;
        $hotel = $validated['estimated_hotel'] ?? 0;
        $other = $validated['estimated_other'] ?? 0;
        $totalBudget = $transport + $hotel + $perDiem + $other;

        $cashAdvance = ($request->input('cash_advance_requested') !== null && $request->input('cash_advance_requested') !== '')
            ? (float) $request->input('cash_advance_requested')
            : $perDiem;

        $hotelLimit = $user->getHotelLimit();
        $nights = max(1, $durationDays - 1);
        $nightlyHotelRate = $nights > 0 ? ($hotel / $nights) : $hotel;

        $policyStatus = 'in_policy';
        $policyNotes = 'Sesuai dengan standar plafon jabatan '.$user->job_level.'.';

        if ($nightlyHotelRate > $hotelLimit) {
            if ($policy && $policy->enforcement_mode === 'strict_block') {
                return back()->withErrors([
                    'estimated_hotel' => 'Pengajuan diblokir oleh kebijakan (Strict Mode): Estimasi tarif hotel per malam melebihi plafon Rp '.number_format($hotelLimit, 0, ',', '.').'.',
                ])->withInput();
            }

            if (empty($validated['out_of_policy_reason']) && $request->boolean('require_justification')) {
                return back()->withErrors([
                    'out_of_policy_reason' => 'Tarif hotel melebihi plafon kebijakan; wajib mengisi alasan justifikasi.',
                ])->withInput();
            }

            $policyStatus = 'out_of_policy';
            $policyNotes = 'Estimasi tarif hotel (Rp '.number_format($nightlyHotelRate, 0, ',', '.').'/malam) melebihi batas plafon jabatan (Rp '.number_format($hotelLimit, 0, ',', '.').').';
        }

        $docPath = null;
        $docName = null;
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $docName = $file->getClientOriginalName();
            $docPath = $file->store('documents', 'local');
        }

        // Determine approver (with active delegation support)
        $primaryApproverId = $user->manager_id ?? User::where('role', 'atasan')->value('id');
        if ($primaryApproverId) {
            $activeDelegation = ApprovalDelegation::where('delegator_id', $primaryApproverId)
                ->where('is_active', true)
                ->whereDate('start_date', '<=', now()->toDateString())
                ->whereDate('end_date', '>=', now()->toDateString())
                ->first();

            if ($activeDelegation) {
                $primaryApproverId = $activeDelegation->delegate_id;
            }
        }

        $directorThreshold = $policy ? (float) $policy->director_threshold : 10000000;
        $requiredLevel = $totalBudget >= $directorThreshold ? 2 : 1;
        $status = $request->input('action') === 'draft' ? 'draft' : 'pending_approval';

        $latestId = TravelRequest::max('id') + 1;
        $requestNumber = 'TRQ-'.date('Y').'-'.str_pad((string) $latestId, 4, '0', STR_PAD_LEFT);

        $travelRequest = TravelRequest::create([
            'request_number' => $requestNumber,
            'user_id' => $user->id,
            'purpose' => $validated['purpose'],
            'origin_city' => $validated['origin_city'],
            'destination_city' => $validated['destination_city'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'duration_days' => $durationDays,
            'transport_mode' => $validated['transport_mode'],
            'flight_hotel_preference' => $validated['flight_hotel_preference'] ?? null,
            'estimated_transport' => $transport,
            'estimated_hotel' => $hotel,
            'estimated_per_diem' => $perDiem,
            'estimated_other' => $other,
            'total_estimated_budget' => $totalBudget,
            'cash_advance_requested' => $cashAdvance,
            'document_path' => $docPath,
            'document_name' => $docName,
            'policy_status' => $policyStatus,
            'policy_notes' => $policyNotes,
            'out_of_policy_reason' => $validated['out_of_policy_reason'] ?? null,
            'status' => $status,
            'approver_id' => $primaryApproverId,
            'current_approval_level' => 1,
            'required_approval_level' => $requiredLevel,
        ]);

        AuditLog::record(
            'SUBMIT_SPPD',
            "Mengajukan SPPD {$travelRequest->request_number} tujuan {$travelRequest->destination_city} (Rp ".number_format($totalBudget, 0, ',', '.').')',
            $travelRequest->request_number,
            $user
        );

        return redirect()->route('requests.show', $travelRequest->request_number)
            ->with('success', "Pengajuan perjalanan dinas {$travelRequest->request_number} berhasil dikirim dan siap ditinjau atasan!");
    }

    /**
     * Update / Resubmit a draft or revision_required travel request.
     */
    public function update(Request $request, string $id)
    {
        $user = $this->getActiveUser();

        $trip = TravelRequest::where(function ($q) use ($id) {
            $q->where('request_number', $id)->orWhere('id', $id);
        })->firstOrFail();

        if (Auth::check() && $user->isUser() && $trip->user_id !== $user->id) {
            abort(403, 'Akses ditolak.');
        }

        if (! in_array($trip->status, ['draft', 'revision_required'], true)) {
            return back()->with('error', 'Pengajuan ini sudah dalam proses dan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'purpose' => 'required|string|max:255',
            'destination_city' => 'required|string|max:100',
            'estimated_transport' => 'required|numeric|min:0',
            'estimated_hotel' => 'required|numeric|min:0',
            'estimated_per_diem' => 'required|numeric|min:0',
            'estimated_other' => 'nullable|numeric|min:0',
        ]);

        $totalBudget = (float) $validated['estimated_transport']
            + (float) $validated['estimated_hotel']
            + (float) $validated['estimated_per_diem']
            + (float) ($validated['estimated_other'] ?? 0);

        $nights = max(1, $trip->duration_days - 1);
        $nightlyRate = $nights > 0 ? ($validated['estimated_hotel'] / $nights) : $validated['estimated_hotel'];
        $hotelLimit = $user->getHotelLimit();

        $trip->update([
            'purpose' => $validated['purpose'],
            'destination_city' => $validated['destination_city'],
            'estimated_transport' => $validated['estimated_transport'],
            'estimated_hotel' => $validated['estimated_hotel'],
            'estimated_per_diem' => $validated['estimated_per_diem'],
            'estimated_other' => $validated['estimated_other'] ?? 0,
            'total_estimated_budget' => $totalBudget,
            'policy_status' => $nightlyRate > $hotelLimit ? 'out_of_policy' : 'in_policy',
            'status' => 'pending_approval',
            'revision_notes' => null,
        ]);

        AuditLog::record(
            'RESUBMIT_SPPD',
            "Mengirim ulang revisi SPPD {$trip->request_number} (Rp ".number_format($totalBudget, 0, ',', '.').')',
            $trip->request_number,
            $user
        );

        return redirect()->route('requests.show', $trip->request_number)
            ->with('success', "Revisi SPPD {$trip->request_number} berhasil dikirim ulang ke Atasan.");
    }

    /**
     * Display the specified travel request with real data.
     */
    public function show(string $id)
    {
        $user = $this->getActiveUser();

        $trip = TravelRequest::with(['user', 'approver', 'settlement'])
            ->where(function ($q) use ($id) {
                $q->where('request_number', $id)->orWhere('id', $id);
            })
            ->firstOrFail();

        // Enforce TC-02: Karyawan cannot open another employee's travel request
        if (Auth::check() && $user->isUser() && $trip->user_id !== $user->id) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk melihat data pengajuan milik karyawan lain.');
        }

        return view('requests.show', compact('trip', 'user'));
    }

    /**
     * Real Check-in at destination city action
     */
    public function checkin(Request $request, string $id)
    {
        $user = $this->getActiveUser();

        $trip = TravelRequest::where(function ($q) use ($id) {
            $q->where('request_number', $id)->orWhere('id', $id);
        })->firstOrFail();

        if (Auth::check() && $user->isUser() && $trip->user_id !== $user->id) {
            abort(403, 'Akses Ditolak.');
        }

        $locationName = $request->input('location') ?? $trip->destination_city;

        $trip->update([
            'checked_in' => true,
            'checkin_location' => $locationName,
            'checkin_at' => now(),
        ]);

        $user->update([
            'last_checkin_city' => $trip->destination_city,
            'last_checkin_location' => $locationName,
            'last_checkin_at' => now(),
        ]);

        AuditLog::record(
            'CHECKIN_TRIP',
            "Check-in perjalanan {$trip->request_number} di lokasi {$locationName}",
            $trip->request_number,
            $user
        );

        return back()->with('success', "Status check-in berhasil diperbarui! Lokasi dinas Anda tercatat di {$locationName}.");
    }

    /**
     * Protected Private Document Download (TC-15)
     */
    public function downloadDocument(string $id, string $type = 'supporting')
    {
        $user = Auth::user();
        if (! $user) {
            abort(403, 'Autentikasi diperlukan untuk mengunduh dokumen privat.');
        }

        $trip = TravelRequest::where(function ($q) use ($id) {
            $q->where('request_number', $id)->orWhere('id', $id);
        })->firstOrFail();

        $canAccess = $trip->user_id === $user->id
            || $trip->approver_id === $user->id
            || $user->isApprover()
            || $user->isTravelAdmin()
            || $user->isFinance()
            || $user->isAdmin();

        if (! $canAccess) {
            abort(403, 'Akses Ditolak: Dokumen privat ini hanya dapat diakses oleh pemilik dan pihak berwenang.');
        }

        $filePath = match ($type) {
            'ticket' => $trip->ticket_file_path,
            'voucher' => $trip->voucher_file_path,
            default => $trip->document_path,
        };

        if ($filePath && Storage::disk('local')->exists($filePath)) {
            return Storage::disk('local')->download($filePath, $trip->document_name ?? basename($filePath));
        }

        if ($filePath && Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath, $trip->document_name ?? basename($filePath));
        }

        // Generate official verifiable summary document if seeded record has no physical file on disk
        $filename = $trip->document_name ?? "Dokumen_{$trip->request_number}.pdf";

        return response("DOKUMEN RESMI PT JAYA ABADI\nNo. SPPD: {$trip->request_number}\nPemohon: {$trip->user->name}\nTujuan: {$trip->destination_city}\nAgenda: {$trip->purpose}\nStatus: {$trip->status_label}\n", 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
