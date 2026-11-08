<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\TravelPolicy;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    protected function getActiveAdmin(): User
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (! $user->isAdmin()) {
                abort(403, 'Akses Ditolak: Halaman ini hanya dapat diakses oleh Super Administrator.');
            }

            return $user;
        }

        return User::where('role', 'admin')->first() ?? User::first();
    }

    /**
     * Display Super Admin executive overview and traveler check-in radar.
     */
    public function index()
    {
        $admin = $this->getActiveAdmin();

        $checkedInUsers = User::whereNotNull('last_checkin_city')
            ->orderByDesc('last_checkin_at')
            ->get();

        $totalSppd = TravelRequest::count();
        $inPolicyCount = TravelRequest::where('policy_status', 'in_policy')->count();
        $complianceRate = $totalSppd > 0 ? round(($inPolicyCount / $totalSppd) * 100, 1) : 100.0;

        $stats = [
            'active_field_count' => max($checkedInUsers->count(), TravelRequest::where('checked_in', true)->count()),
            'total_sppd' => $totalSppd,
            'compliance_rate' => $complianceRate,
            'total_budget' => TravelRequest::whereIn('status', ['approved', 'ticket_issued', 'completed'])->sum('total_estimated_budget'),
        ];

        return view('admin.index', compact('admin', 'checkedInUsers', 'stats'));
    }

    /**
     * Display employee master data and approval structure management.
     */
    public function users(Request $request)
    {
        $admin = $this->getActiveAdmin();

        $query = User::with(['manager', 'secondApprover']);

        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        if ($request->filled('department') && $request->department !== 'all') {
            $query->where('department', 'like', "%{$request->department}%");
        }

        $users = $query->orderBy('id')->get();
        $approvers = User::whereIn('role', ['atasan', 'approver', 'admin'])->get();

        return view('admin.users', compact('admin', 'users', 'approvers'));
    }

    /**
     * Store a newly created employee account in Master Karyawan.
     */
    public function storeUser(Request $request)
    {
        $admin = $this->getActiveAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'employee_id' => 'required|string|max:50',
            'role' => 'required|in:user,atasan,travel_admin,finance,admin',
            'job_level' => 'required|string|max:100',
            'department' => 'nullable|string|max:150',
            'manager_id' => 'nullable|exists:users,id',
            'second_approver_id' => 'nullable|exists:users,id',
        ]);

        $newUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password123'),
            'employee_id' => $validated['employee_id'],
            'role' => $validated['role'],
            'job_level' => $validated['job_level'],
            'department' => $validated['department'] ?? 'Engineering & IT Infrastructure',
            'manager_id' => $validated['manager_id'] ?? null,
            'second_approver_id' => $validated['second_approver_id'] ?? null,
            'is_active' => true,
        ]);

        AuditLog::record(
            'CREATE_USER',
            "Menambahkan karyawan baru {$newUser->name} ({$newUser->employee_id}) dengan role {$newUser->role_label}",
            $newUser->employee_id,
            $admin
        );

        return redirect()->route('admin.users')
            ->with('success', "Akun karyawan {$newUser->name} ({$newUser->employee_id}) berhasil ditambahkan!");
    }

    /**
     * Toggle active status of a user.
     */
    public function toggleUserStatus(int $id)
    {
        $admin = $this->getActiveAdmin();

        $targetUser = User::findOrFail($id);
        $targetUser->update(['is_active' => ! $targetUser->is_active]);

        $statusLabel = $targetUser->is_active ? 'mengaktifkan' : 'menonaktifkan';

        AuditLog::record(
            'UPDATE_USER_STATUS',
            "Super Admin {$statusLabel} akun {$targetUser->name} ({$targetUser->employee_id})",
            $targetUser->employee_id,
            $admin
        );

        return redirect()->route('admin.users')
            ->with('success', "Status akun {$targetUser->name} berhasil diperbarui.");
    }

    /**
     * Display travel policy rules and cost ceiling matrix.
     */
    public function policies()
    {
        $admin = $this->getActiveAdmin();

        $policies = TravelPolicy::orderBy('id')->get();
        $firstPolicy = $policies->first();

        return view('admin.policies', compact('admin', 'policies', 'firstPolicy'));
    }

    /**
     * Update Travel Policy matrix and workflow thresholds (TC-17).
     */
    public function updatePolicies(Request $request)
    {
        $admin = $this->getActiveAdmin();

        $validated = $request->validate([
            'policies' => 'nullable|array',
            'policies.*.hotel_limit' => 'required|numeric|min:0',
            'policies.*.per_diem_limit' => 'required|numeric|min:0',
            'policies.*.flight_class' => 'nullable|string|max:100',
            'policies.*.train_class' => 'nullable|string|max:100',
            'director_threshold' => 'nullable|numeric|min:0',
            'sla_hours' => 'nullable|integer|min:1',
            'enforcement_mode' => 'nullable|in:warn_justify,strict_block',
        ]);

        if (! empty($validated['policies'])) {
            foreach ($validated['policies'] as $jobLevel => $data) {
                $policy = TravelPolicy::where('job_level', $jobLevel)->orWhere('id', $jobLevel)->first();
                if ($policy) {
                    $policy->update([
                        'hotel_limit' => $data['hotel_limit'],
                        'per_diem_limit' => $data['per_diem_limit'],
                        'flight_class' => $data['flight_class'] ?? $policy->flight_class,
                        'train_class' => $data['train_class'] ?? $policy->train_class,
                    ]);
                }
            }
        }

        $globalUpdate = array_filter([
            'director_threshold' => $validated['director_threshold'] ?? null,
            'sla_hours' => $validated['sla_hours'] ?? null,
            'enforcement_mode' => $validated['enforcement_mode'] ?? null,
        ], fn ($v) => $v !== null);

        if (! empty($globalUpdate)) {
            TravelPolicy::query()->update($globalUpdate);
        }

        AuditLog::record(
            'UPDATE_POLICY',
            'Memperbarui matriks plafon biaya Travel Policy & ambang batas persetujuan Direktur.',
            'TRAVEL_POLICY',
            $admin
        );

        return redirect()->route('admin.policies')
            ->with('success', 'Konfigurasi Travel Policy & Plafon Biaya berhasil diperbarui dan dicatat dalam Audit Log!');
    }

    /**
     * Display system audit logs and activity trail.
     */
    public function auditLogs(Request $request)
    {
        $admin = $this->getActiveAdmin();

        $query = AuditLog::query();

        if ($request->filled('action') && $request->action !== 'all') {
            $query->where('action', 'like', "%{$request->action}%");
        }

        if ($request->filled('actor') && $request->actor !== 'all') {
            $query->where('actor_name', 'like', "%{$request->actor}%");
        }

        $logs = $query->orderByDesc('id')->get();

        return view('admin.audit-logs', compact('admin', 'logs'));
    }

    /**
     * Export Audit Logs to CSV.
     */
    public function exportAuditLogs(): StreamedResponse
    {
        $this->getActiveAdmin();

        $logs = AuditLog::orderByDesc('id')->get();

        return response()->streamDownload(function () use ($logs) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Timestamp', 'Aktor', 'Jabatan / Role', 'Kode Aksi', 'Referensi Objek', 'Deskripsi', 'IP Address', 'Status']);
            foreach ($logs as $log) {
                fputcsv($handle, [
                    $log->created_at?->format('Y-m-d H:i:s'),
                    $log->actor_name,
                    $log->actor_role,
                    $log->action,
                    $log->target_ref,
                    $log->description,
                    $log->ip_address,
                    $log->status,
                ]);
            }
            fclose($handle);
        }, 'Audit_Trail_Log_CTMS.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
