<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSettingsController extends Controller
{
    protected function getActiveUser(): User
    {
        return Auth::user() ?? User::where('role', 'user')->first() ?? User::first();
    }

    public function index()
    {
        $user = $this->getActiveUser();

        return view('settings.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $this->getActiveUser();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'bank_name' => 'required|string|max:50',
            'bank_account_number' => 'required|string|max:50',
            'bank_account_holder' => 'required|string|max:255',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil dan informasi rekening pencairan dana berhasil diperbarui!');
    }
}
