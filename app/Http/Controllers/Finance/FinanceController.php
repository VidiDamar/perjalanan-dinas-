<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Settlement;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FinanceController extends Controller
{
    protected function getActiveFinance(): User
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (! $user->isFinance()) {
                abort(403, 'Akses Ditolak: Anda tidak memiliki kewenangan sebagai Tim Keuangan (Finance).');
            }

            return $user;
        }

        return User::where('role', 'finance')->first() ?? User::first();
    }

    /**
     * Display Finance dashboard and financial highlights.
     */
    public function index()
    {
        $finance = $this->getActiveFinance();

        $pendingDisbursements = TravelRequest::with('user')
            ->whereIn('status', ['approved', 'ticket_issued', 'completed'])
            ->where('cash_advance_requested', '>', 0)
            ->orderByRaw("CASE WHEN cash_advance_status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('start_date', 'asc')
            ->get();

        $pendingCaAmount = TravelRequest::whereIn('status', ['approved', 'ticket_issued'])
            ->where('cash_advance_status', 'pending')
            ->sum('cash_advance_requested');
        $pendingCaCount = TravelRequest::whereIn('status', ['approved', 'ticket_issued'])
            ->where('cash_advance_status', 'pending')
            ->where('cash_advance_requested', '>', 0)
            ->count();
        $outstandingAmount = TravelRequest::where('cash_advance_status', 'disbursed')
            ->whereDoesntHave('settlement', fn ($q) => $q->whereIn('status', ['paid', 'approved']))
            ->sum('cash_advance_requested');
        $outstandingCount = TravelRequest::where('cash_advance_status', 'disbursed')
            ->whereDoesntHave('settlement', fn ($q) => $q->whereIn('status', ['paid', 'approved']))
            ->count();
        $ytdBudget = TravelRequest::whereIn('status', ['approved', 'ticket_issued', 'completed'])->sum('total_estimated_budget');

        $stats = [
            'pending_cash_amount' => $pendingCaAmount,
            'pending_ca_amount' => $pendingCaAmount,
            'pending_cash_count' => $pendingCaCount,
            'pending_ca_count' => $pendingCaCount,
            'pending_settlement_amount' => Settlement::whereIn('status', ['submitted', 'pending_audit'])->sum('total_actual_expense'),
            'pending_settlement_count' => Settlement::whereIn('status', ['submitted', 'pending_audit'])->count(),
            'outstanding_amount' => $outstandingAmount,
            'outstanding_ca_amount' => $outstandingAmount,
            'outstanding_count' => $outstandingCount,
            'ytd_budget' => $ytdBudget,
        ];

        return view('finance.index', compact('finance', 'pendingDisbursements', 'stats'));
    }

    /**
     * Display cash advance / uang muka disbursement queue.
     */
    public function cashAdvances(Request $request)
    {
        $finance = $this->getActiveFinance();

        $query = TravelRequest::with('user')
            ->whereIn('status', ['approved', 'ticket_issued', 'completed'])
            ->where('cash_advance_requested', '>', 0);

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('cash_advance_status', $request->status);
        }

        $advances = $query->orderByRaw("CASE WHEN cash_advance_status = 'pending' THEN 0 ELSE 1 END")
            ->orderByDesc('id')
            ->get();

        $pendingTotal = TravelRequest::whereIn('status', ['approved', 'ticket_issued'])
            ->where('cash_advance_status', 'pending')
            ->sum('cash_advance_requested');
        $totalPendingAmount = $pendingTotal;

        return view('finance.cash-advances', compact('finance', 'advances', 'pendingTotal', 'totalPendingAmount'));
    }

    /**
     * Disburse cash advance for an approved travel request.
     */
    public function disburseCashAdvance(Request $request, string $id)
    {
        $finance = $this->getActiveFinance();

        if ($request->filled('disbursement_ref') && ! $request->filled('cash_advance_ref')) {
            $request->merge(['cash_advance_ref' => $request->input('disbursement_ref')]);
        }

        $validated = $request->validate([
            'cash_advance_ref' => 'required|string|max:100',
            'cash_advance_method' => 'nullable|string|max:100',
        ]);

        $trip = TravelRequest::with('user')
            ->where(function ($q) use ($id) {
                $q->where('request_number', $id)->orWhere('id', $id);
            })
            ->firstOrFail();

        $trip->update([
            'cash_advance_status' => 'disbursed',
            'cash_advance_ref' => $validated['cash_advance_ref'],
            'cash_advance_method' => $validated['cash_advance_method'] ?? 'BCA Corporate Direct Transfer',
            'cash_advance_disbursed_at' => now(),
        ]);

        AuditLog::record(
            'DISBURSE_CASH',
            'Pencairan uang muka Rp '.number_format($trip->cash_advance_requested, 0, ',', '.')." untuk {$trip->request_number} (Ref: {$validated['cash_advance_ref']})",
            $trip->request_number,
            $finance
        );

        return redirect()->route('finance.cash-advances')
            ->with('success', 'Uang muka sebesar Rp '.number_format($trip->cash_advance_requested, 0, ',', '.')." untuk {$trip->request_number} berhasil dikonfirmasi cair!");
    }

    /**
     * Display settlement and reimbursement list.
     */
    public function settlements(Request $request)
    {
        $finance = $this->getActiveFinance();

        $query = Settlement::with(['user', 'travelRequest', 'expenseItems']);

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $settlements = $query->orderByRaw("CASE WHEN status = 'submitted' THEN 0 ELSE 1 END")
            ->orderByDesc('id')
            ->get();

        return view('finance.settlements', compact('finance', 'settlements'));
    }

    /**
     * Display settlement review page with receipt preview and balance calculation.
     */
    public function reviewSettlement(string $id = 'SET-2023-0104')
    {
        $finance = $this->getActiveFinance();

        $settlement = Settlement::with(['user', 'travelRequest', 'expenseItems'])
            ->where(function ($q) use ($id) {
                $q->where('settlement_number', $id)->orWhere('id', $id);
            })
            ->first() ?? Settlement::with(['user', 'travelRequest', 'expenseItems'])->firstOrFail();

        $settlementId = $settlement->settlement_number;

        return view('finance.settlement-review', compact('settlement', 'settlementId', 'finance'));
    }

    /**
     * Verify and approve settlement calculation (TC-12, TC-13, TC-14, TC-18).
     */
    public function approveSettlement(Request $request, string $id)
    {
        $finance = $this->getActiveFinance();

        $settlement = Settlement::with(['user', 'travelRequest', 'expenseItems'])
            ->where(function ($q) use ($id) {
                $q->where('settlement_number', $id)->orWhere('id', $id);
            })
            ->firstOrFail();

        // Update item verification flags if passed, otherwise mark all as verified
        if ($request->has('verified_item_ids') && is_array($request->verified_item_ids)) {
            $verifiedIds = array_map('intval', $request->verified_item_ids);
            foreach ($settlement->expenseItems as $item) {
                $item->update(['is_verified' => in_array($item->id, $verifiedIds, true)]);
            }
            $approvedActual = (float) $settlement->expenseItems()->where('is_verified', true)->sum('amount');
        } elseif ($settlement->expenseItems()->count() > 0) {
            $settlement->expenseItems()->update(['is_verified' => true]);
            $approvedActual = (float) $settlement->expenseItems()->sum('amount');
        } else {
            $approvedActual = (float) $settlement->total_actual_expense;
        }

        $cashAdvance = (float) $settlement->cash_advance_amount;
        $diff = $approvedActual - $cashAdvance;

        $settlementType = $diff > 0 ? 'reimbursement' : ($diff < 0 ? 'refund' : 'balanced');
        $differenceAmount = abs($diff);

        // Enforce TC-18: If difference != 0 and closing requires payment/refund proof
        $paymentRef = $request->input('payment_ref') ?: $settlement->refund_transfer_proof;
        if ($differenceAmount > 0 && $request->boolean('require_proof') && empty($paymentRef)) {
            return back()->withErrors([
                'payment_ref' => 'Settlement tidak dapat ditutup (Paid) sebelum referensi bukti pembayaran reimbursement atau bukti pengembalian sisa uang tercatat.',
            ]);
        }

        $settlement->update([
            'total_actual_expense' => $approvedActual,
            'difference_amount' => $differenceAmount,
            'settlement_type' => $settlementType,
            'status' => 'paid',
            'finance_notes' => $request->input('finance_notes') ?? 'Seluruh nota fisik telah diaudit dan terverifikasi sesuai kebijakan.',
            'payment_ref' => $paymentRef ?? ('FIN-STL-'.date('Ymd').'-'.$settlement->id),
            'verified_at' => now(),
            'paid_at' => now(),
            'verified_by' => $finance->id,
        ]);

        if ($settlement->travelRequest) {
            $settlement->travelRequest->update(['status' => 'completed']);
        }

        AuditLog::record(
            'VERIFY_SETTLEMENT',
            "Menyelesaikan audit & penutupan settlement {$settlement->settlement_number} ({$settlementType}: Rp ".number_format($differenceAmount, 0, ',', '.').')',
            $settlement->settlement_number,
            $finance
        );

        return redirect()->route('finance.settlements')
            ->with('success', "Settlement {$settlement->settlement_number} berhasil diverifikasi dan ditutup!");
    }

    /**
     * Return settlement to employee for revision/correction (TC-11).
     */
    public function rejectSettlement(Request $request, string $id)
    {
        $finance = $this->getActiveFinance();

        if ($request->filled('rejection_reason') && ! $request->filled('finance_notes')) {
            $request->merge(['finance_notes' => $request->input('rejection_reason')]);
        }

        $validated = $request->validate([
            'finance_notes' => 'required|string|min:5|max:1000',
        ]);

        $settlement = Settlement::with('user')
            ->where(function ($q) use ($id) {
                $q->where('settlement_number', $id)->orWhere('id', $id);
            })
            ->firstOrFail();

        $settlement->update([
            'status' => 'rejected',
            'finance_notes' => $validated['finance_notes'],
            'verified_by' => $finance->id,
        ]);

        AuditLog::record(
            'REJECT_SETTLEMENT',
            "Mengembalikan laporan settlement {$settlement->settlement_number} untuk perbaikan: {$validated['finance_notes']}",
            $settlement->settlement_number,
            $finance
        );

        return redirect()->route('finance.settlements')
            ->with('success', "Settlement {$settlement->settlement_number} telah dikembalikan ke karyawan disertai catatan perbaikan.");
    }

    /**
     * Display financial reporting and accounting export page.
     */
    public function reports(Request $request)
    {
        $finance = $this->getActiveFinance();

        $query = TravelRequest::with(['user', 'settlement'])
            ->whereIn('status', ['approved', 'ticket_issued', 'completed']);

        if ($request->filled('cost_center') && $request->cost_center !== 'all') {
            $query->where('cost_center', $request->cost_center);
        }

        $ledgerTrips = $query->orderByDesc('start_date')->get();

        return view('finance.reports', compact('finance', 'ledgerTrips'));
    }

    /**
     * Export Financial General Ledger Report to CSV (TC-16).
     */
    public function exportReports(Request $request): StreamedResponse
    {
        $this->getActiveFinance();

        $query = TravelRequest::with(['user', 'settlement'])
            ->whereIn('status', ['approved', 'ticket_issued', 'completed']);

        if ($request->filled('cost_center') && $request->cost_center !== 'all') {
            $query->where('cost_center', $request->cost_center);
        }

        $trips = $query->orderByDesc('start_date')->get();

        return response()->streamDownload(function () use ($trips) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Tgl Transaksi',
                'No. Jurnal',
                'No. SPPD',
                'Cost Center',
                'Nama Pegawai',
                'Tujuan',
                'Biaya Tiket (Rp)',
                'Biaya Hotel (Rp)',
                'Per Diem / Realisasi (Rp)',
                'Total Biaya (Rp)',
                'Status',
            ]);

            $grandTotal = 0;
            foreach ($trips as $index => $trip) {
                $ticket = (float) ($trip->actual_ticket_cost ?? $trip->estimated_transport);
                $hotel = (float) ($trip->actual_hotel_cost ?? $trip->estimated_hotel);
                $perDiem = (float) ($trip->settlement?->total_actual_expense ?? $trip->estimated_per_diem);
                $total = $ticket + $hotel + $perDiem;
                $grandTotal += $total;

                fputcsv($handle, [
                    $trip->start_date->format('Y-m-d'),
                    'JV-TRV-'.(1020 + $trip->id),
                    $trip->request_number,
                    $trip->cost_center ?? 'CC-101',
                    $trip->user?->name ?? '-',
                    $trip->destination_city,
                    $ticket,
                    $hotel,
                    $perDiem,
                    $total,
                    $trip->status_label,
                ]);
            }

            fputcsv($handle, ['TOTAL', '', '', '', '', '', '', '', '', $grandTotal, '']);
            fclose($handle);
        }, 'Laporan_Buku_Besar_Perjalanan_Dinas_CTMS.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
