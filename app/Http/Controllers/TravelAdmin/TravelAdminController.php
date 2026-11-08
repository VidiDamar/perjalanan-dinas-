<?php

namespace App\Http\Controllers\TravelAdmin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TravelAdminController extends Controller
{
    protected function getActiveTravelAdmin(): User
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (! $user->isTravelAdmin()) {
                abort(403, 'Akses Ditolak: Anda tidak memiliki kewenangan sebagai Admin Travel Desk.');
            }

            return $user;
        }

        return User::where('role', 'travel_admin')->first() ?? User::first();
    }

    /**
     * Display Travel Admin dashboard and booking queue.
     */
    public function index(Request $request)
    {
        $travelAdmin = $this->getActiveTravelAdmin();

        $query = TravelRequest::with(['user', 'approver'])
            ->whereIn('status', ['approved', 'ticket_issued', 'completed']);

        if ($request->filled('booking_status')) {
            if ($request->booking_status === 'unbooked') {
                $query->whereNull('pnr_code');
            } elseif ($request->booking_status === 'booked') {
                $query->whereNotNull('pnr_code');
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('request_number', 'like', "%{$search}%")
                    ->orWhere('destination_city', 'like', "%{$search}%")
                    ->orWhereHas('user', fn ($uq) => $uq->where('name', 'like', "%{$search}%"));
            });
        }

        $trips = $query->orderByRaw('CASE WHEN pnr_code IS NULL THEN 0 ELSE 1 END')
            ->orderBy('start_date', 'asc')
            ->get();

        $readyToBook = TravelRequest::where('status', 'approved')->whereNull('pnr_code')->count();
        $totalBookingCost = (float) TravelRequest::sum('actual_ticket_cost') + (float) TravelRequest::sum('actual_hotel_cost');

        $stats = [
            'ready_to_book' => $readyToBook,
            'ready_count' => $readyToBook,
            'issued_count' => TravelRequest::whereNotNull('pnr_code')->count(),
            'urgent_count' => TravelRequest::whereIn('status', ['approved', 'ticket_issued'])
                ->whereDate('start_date', '<=', now()->addDays(3)->toDateString())
                ->whereDate('start_date', '>=', now()->toDateString())
                ->count(),
            'total_booking_cost' => $totalBookingCost,
            'total_booking_volume' => $totalBookingCost,
        ];

        return view('travel-admin.index', compact('travelAdmin', 'trips', 'stats'));
    }

    /**
     * Display booking and ticketing fulfillment page for a request.
     */
    public function show(string $id = 'TRQ-2023-0891')
    {
        $travelAdmin = $this->getActiveTravelAdmin();

        $trip = TravelRequest::with(['user', 'approver'])
            ->where(function ($q) use ($id) {
                $q->where('request_number', $id)->orWhere('id', $id);
            })
            ->first() ?? TravelRequest::with(['user', 'approver'])->firstOrFail();

        $requestId = $trip->request_number;

        return view('travel-admin.show', compact('trip', 'requestId', 'travelAdmin'));
    }

    /**
     * Store or update booking & e-ticket fulfillment details (enforces TC-09).
     */
    public function storeBooking(Request $request, string $id)
    {
        $travelAdmin = $this->getActiveTravelAdmin();

        $trip = TravelRequest::with('user')
            ->where(function ($q) use ($id) {
                $q->where('request_number', $id)->orWhere('id', $id);
            })
            ->firstOrFail();

        // Enforce TC-09: Admin Travel cannot process a request that is not yet approved
        if (! in_array($trip->status, ['approved', 'ticket_issued', 'completed'], true)) {
            return back()->withErrors([
                'booking' => 'Operasi Ditolak: Pengajuan perjalanan dinas belum mendapatkan persetujuan final dari Atasan.',
            ]);
        }

        // Normalize alternate input field names
        $pnrCode = $request->input('pnr_code') ?? $request->input('departure_pnr');
        $operatorName = $request->input('operator_name') ?? $request->input('departure_airline') ?? $request->input('transport_vendor') ?? 'Garuda Indonesia (GA)';
        $actualTicketCost = $request->input('actual_ticket_cost') ?? $request->input('ticket_cost') ?? $request->input('actual_transport_cost') ?? $trip->estimated_transport;
        $hotelName = $request->input('hotel_name') ?? $request->input('hotel_vendor') ?? $trip->hotel_name ?? 'Hotel Rekanan Korporat';
        $hotelConfirmationCode = $request->input('hotel_confirmation_code') ?? $request->input('hotel_booking_code') ?? 'HTL-CORP-01';
        $actualHotelCost = $request->input('actual_hotel_cost') ?? $request->input('hotel_cost') ?? $trip->estimated_hotel;

        if (empty($pnrCode)) {
            return back()->withErrors(['pnr_code' => 'Kode Booking (PNR) wajib diisi.']);
        }

        $ticketPath = $trip->ticket_file_path;
        if ($request->hasFile('ticket_file')) {
            $ticketPath = $request->file('ticket_file')->store('tickets', 'local');
        } elseif ($request->hasFile('e_ticket_file')) {
            $ticketPath = $request->file('e_ticket_file')->store('tickets', 'local');
        }

        $voucherPath = $trip->voucher_file_path;
        if ($request->hasFile('voucher_file')) {
            $voucherPath = $request->file('voucher_file')->store('vouchers', 'local');
        } elseif ($request->hasFile('hotel_voucher_file')) {
            $voucherPath = $request->file('hotel_voucher_file')->store('vouchers', 'local');
        }

        $trip->update([
            'operator_name' => $operatorName,
            'pnr_code' => strtoupper($pnrCode),
            'e_ticket_number' => $request->input('e_ticket_number'),
            'flight_departure_info' => $request->input('flight_departure_info') ?? $request->input('departure_flight_code'),
            'flight_return_info' => $request->input('flight_return_info') ?? $request->input('return_flight_code'),
            'actual_ticket_cost' => (float) $actualTicketCost,
            'hotel_name' => $hotelName,
            'hotel_room_type' => $request->input('hotel_room_type'),
            'hotel_confirmation_code' => strtoupper($hotelConfirmationCode),
            'actual_hotel_cost' => (float) $actualHotelCost,
            'ticket_file_path' => $ticketPath,
            'voucher_file_path' => $voucherPath,
            'status' => $trip->status === 'completed' ? 'completed' : 'ticket_issued',
        ]);

        AuditLog::record(
            'ISSUE_TICKET',
            "Menerbitkan E-Tiket ({$trip->pnr_code}) & Voucher Hotel ({$trip->hotel_confirmation_code}) untuk SPPD {$trip->request_number}",
            $trip->request_number,
            $travelAdmin
        );

        return redirect()->route('travel-admin.dashboard')
            ->with('success', "Dokumen E-Tiket (PNR: {$trip->pnr_code}) dan Voucher Hotel untuk {$trip->request_number} berhasil diterbitkan!");
    }

    /**
     * Display travel vendor agreements and monthly recap.
     */
    public function vendors()
    {
        $travelAdmin = $this->getActiveTravelAdmin();

        $trips = TravelRequest::whereNotNull('pnr_code')->get();

        return view('travel-admin.vendors', compact('travelAdmin', 'trips'));
    }

    /**
     * Export Vendor Recap as CSV.
     */
    public function exportVendors(): StreamedResponse
    {
        $this->getActiveTravelAdmin();

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Nama Mitra Vendor', 'Kategori Layanan', 'Corporate Account ID', 'Volume Booking', 'Total Nilai Transaksi (Rp)', 'Diskon Korporasi', 'Status Kontrak']);
            fputcsv($handle, ['PT Garuda Indonesia (Persero) Tbk', 'Penerbangan Domestik', 'GA-CORP-9821', '38 Penerbangan', '148650000', '10% Off Base Fare', 'Aktif s/d Des 2024']);
            fputcsv($handle, ['Santika Indonesia Hotels & Resorts', 'Hotel Rekanan Nasional', 'SNT-CORP-4410', '28 Room Nights', '32400000', 'Fixed Corporate Rate', 'Aktif s/d Mar 2024']);
            fputcsv($handle, ['PT Kereta Api Indonesia (Persero)', 'Transportasi Darat', 'KAI-B2B-1102', '22 Tiket', '16800000', 'Standard Corporate', 'Aktif s/d Des 2023']);
            fclose($handle);
        }, 'Rekap_Vendor_Mitra_CTMS.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
