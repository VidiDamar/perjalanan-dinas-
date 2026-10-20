<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TravelRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Filter by Status
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

        // Search by request number, purpose, or city
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('request_number', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhere('destination_city', 'like', "%{$search}%");
            });
        }

        $requests = $query->orderByDesc('id')->paginate(10)->withQueryString();

        // Calculate summary stats
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
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        // Calculate duration days
        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);
        $durationDays = max(1, $start->diffInDays($end) + 1);

        // Auto-calculate Per Diem if not supplied
        $dailyPerDiemLimit = $user->getDailyPerDiemLimit();
        $perDiem = ($validated['estimated_per_diem'] ?? null) ?: ($dailyPerDiemLimit * $durationDays);
        $transport = $validated['estimated_transport'] ?? 0;
        $hotel = $validated['estimated_hotel'] ?? 0;
        $other = $validated['estimated_other'] ?? 0;
        $totalBudget = $transport + $hotel + $perDiem + $other;

        // Cash advance: use custom value from form, or fall back to per diem total
        $cashAdvance = ($request->input('cash_advance_requested') !== null && $request->input('cash_advance_requested') !== '')
            ? (float) $request->input('cash_advance_requested')
            : $perDiem;

        // Auto-check Travel Policy
        $hotelLimit = $user->getHotelLimit();
        $nights = max(1, $durationDays - 1);
        $nightlyHotelRate = $nights > 0 ? ($hotel / $nights) : $hotel;

        $policyStatus = 'in_policy';
        $policyNotes = 'Sesuai dengan standar plafon jabatan '.$user->job_level.'.';

        if ($nightlyHotelRate > $hotelLimit) {
            $policyStatus = 'out_of_policy';
            $policyNotes = 'Estimasi tarif hotel (Rp '.number_format($nightlyHotelRate, 0, ',', '.').'/malam) melebihi batas plafon jabatan (Rp '.number_format($hotelLimit, 0, ',', '.').').';
        }

        // Handle Document Upload
        $docPath = null;
        $docName = null;
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $docName = $file->getClientOriginalName();
            $docPath = $file->store('documents', 'public');
        }

        // Generate unique request number (TRQ-YYYY-XXXX)
        $latestId = TravelRequest::max('id') + 1;
        $requestNumber = 'TRQ-'.date('Y').'-'.str_pad($latestId, 4, '0', STR_PAD_LEFT);

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
            'status' => 'pending_approval',
            'approver_id' => $user->manager_id ?? User::where('role', 'atasan')->value('id'),
        ]);

        return redirect()->route('requests.show', $travelRequest->request_number)
            ->with('success', "Pengajuan perjalanan dinas {$travelRequest->request_number} berhasil dikirim dan siap ditinjau atasan!");
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

        return back()->with('success', "Status check-in berhasil diperbarui! Lokasi dinas Anda tercatat di {$locationName}.");
    }
}
