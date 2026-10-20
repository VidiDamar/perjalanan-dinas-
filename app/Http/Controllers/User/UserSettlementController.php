<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Settlement;
use App\Models\SettlementExpenseItem;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettlementController extends Controller
{
    protected function getActiveUser(): User
    {
        return Auth::user() ?? User::where('role', 'user')->first() ?? User::first();
    }

    /**
     * Display a listing of settlements and claim submission form.
     */
    public function index(Request $request)
    {
        $user = $this->getActiveUser();

        // All settlements belonging to user
        $settlements = Settlement::with(['travelRequest', 'expenseItems'])
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->get();

        // Approved/completed trips without settlement
        $availableTrips = TravelRequest::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'ticket_issued', 'completed'])
            ->whereDoesntHave('settlement')
            ->orderByDesc('id')
            ->get();

        // Selected trip or settlement
        $selectedTripId = $request->query('trip_id') ?? ($availableTrips->first()?->id);
        $selectedTrip = $selectedTripId ? TravelRequest::find($selectedTripId) : null;

        return view('settlements.index', compact('user', 'settlements', 'availableTrips', 'selectedTrip'));
    }

    /**
     * Store newly submitted settlement and receipts into database.
     */
    public function store(Request $request)
    {
        $user = $this->getActiveUser();

        $validated = $request->validate([
            'travel_request_id' => 'required|exists:travel_requests,id',
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.category' => 'required|string',
            'items.*.merchant_name' => 'required|string|max:255',
            'items.*.expense_date' => 'required|date',
            'items.*.amount' => 'required|numeric|min:1000',
            'items.*.description' => 'nullable|string|max:255',
            'items.*.receipt' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $trip = TravelRequest::where('id', $validated['travel_request_id'])
            ->where('user_id', $user->id)
            ->firstOrFail();

        $cashAdvance = $trip->cash_advance_requested ?? 0;
        $totalActual = 0;

        foreach ($validated['items'] as $item) {
            $totalActual += (float) $item['amount'];
        }

        $difference = $totalActual - $cashAdvance;
        $settlementType = $difference >= 0 ? 'reimbursement' : 'refund';

        // Generate Settlement Number (SET-YYYY-XXXX)
        $latestId = Settlement::max('id') + 1;
        $settlementNumber = 'SET-'.date('Y').'-'.str_pad($latestId, 4, '0', STR_PAD_LEFT);

        $settlement = Settlement::create([
            'settlement_number' => $settlementNumber,
            'travel_request_id' => $trip->id,
            'user_id' => $user->id,
            'cash_advance_amount' => $cashAdvance,
            'total_actual_expense' => $totalActual,
            'difference_amount' => abs($difference),
            'settlement_type' => $settlementType,
            'notes' => $validated['notes'] ?? null,
            'status' => 'submitted',
        ]);

        // Save each expense item
        foreach ($validated['items'] as $index => $itemData) {
            $receiptPath = null;
            if ($request->hasFile("items.{$index}.receipt")) {
                $receiptPath = $request->file("items.{$index}.receipt")->store('receipts', 'public');
            }

            SettlementExpenseItem::create([
                'settlement_id' => $settlement->id,
                'category' => $itemData['category'],
                'merchant_name' => $itemData['merchant_name'],
                'expense_date' => $itemData['expense_date'],
                'amount' => $itemData['amount'],
                'description' => $itemData['description'] ?? null,
                'receipt_path' => $receiptPath,
                'is_verified' => false,
            ]);
        }

        // Update travel request status to completed
        $trip->update(['status' => 'completed']);

        return redirect()->route('settlements.index')
            ->with('success', "Pertanggungjawaban biaya {$settlementNumber} berhasil diajukan dan menunggu audit Tim Keuangan!");
    }
}
