<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TravelRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApprovalController extends Controller
{
    protected function getActiveUser(): User
    {
        return Auth::user() ?? User::where('role', 'user')->first() ?? User::first();
    }

    public function index(Request $request)
    {
        $user = $this->getActiveUser();

        $requests = TravelRequest::with(['approver'])
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->get();

        $selectedId = $request->query('id') ?? $requests->first()?->id;
        $selectedTrip = $selectedId ? TravelRequest::with(['approver'])->find($selectedId) : null;

        return view('approvals.index', compact('user', 'requests', 'selectedTrip'));
    }
}
