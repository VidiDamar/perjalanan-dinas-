<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Settlement;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    protected function getActiveUser(): User
    {
        return Auth::user() ?? User::where('role', 'user')->first() ?? User::first();
    }

    public function index()
    {
        $user = $this->getActiveUser();

        // 1. Upcoming or active nearest trip for hero card
        $activeTrip = TravelRequest::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'ticket_issued'])
            ->orderBy('start_date', 'asc')
            ->first();

        // If no upcoming approved trip, get the latest request
        if (! $activeTrip) {
            $activeTrip = TravelRequest::where('user_id', $user->id)
                ->orderByDesc('id')
                ->first();
        }

        // 2. Real Summary Statistics
        $stats = [
            'total_trips' => TravelRequest::where('user_id', $user->id)->count(),
            'pending_approval' => TravelRequest::where('user_id', $user->id)->where('status', 'pending_approval')->count(),
            'approved_trips' => TravelRequest::where('user_id', $user->id)->whereIn('status', ['approved', 'ticket_issued'])->count(),
            'settlement_claims' => Settlement::where('user_id', $user->id)->count(),
        ];

        // 3. Recent 5 travel requests
        $recentTrips = TravelRequest::where('user_id', $user->id)
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('dashboard', compact('user', 'activeTrip', 'recentTrips', 'stats'));
    }
}
