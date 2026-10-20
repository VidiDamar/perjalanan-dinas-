<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Approver\ApprovalController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TravelAdmin\TravelAdminController;
use App\Http\Controllers\User\TravelRequestController;
use App\Http\Controllers\User\UserApprovalController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserSettingsController;
use App\Http\Controllers\User\UserSettlementController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [UserDashboardController::class, 'index']);

// Quick Role Switcher for development & demo purposes
Route::get('/switch-role/{role}', function (string $role) {
    $emailMap = [
        'user' => 'user@gmail.com',
        'atasan' => 'atasan@gmail.com',
        'approver' => 'atasan@gmail.com',
        'travel_admin' => 'travel@gmail.com',
        'finance' => 'finance@gmail.com',
        'admin' => 'admin@gmail.com',
    ];

    $redirectMap = [
        'user' => 'dashboard',
        'atasan' => 'approver.dashboard',
        'approver' => 'approver.dashboard',
        'travel_admin' => 'travel-admin.dashboard',
        'finance' => 'finance.dashboard',
        'admin' => 'admin.dashboard',
    ];

    if (isset($emailMap[$role])) {
        $user = User::where('email', $emailMap[$role])->first();
        if ($user) {
            Auth::login($user);
        }
    }

    $targetRoute = $redirectMap[$role] ?? 'dashboard';

    return redirect()->route($targetRoute);
})->name('switch-role');

// ==========================================
// 1. Modul Karyawan (User / Traveler)
// ==========================================
Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

Route::get('/requests', [TravelRequestController::class, 'index'])->name('requests.index');
Route::get('/requests/create', [TravelRequestController::class, 'create'])->name('requests.create');
Route::post('/requests', [TravelRequestController::class, 'store'])->name('requests.store');
Route::get('/requests/{id}', [TravelRequestController::class, 'show'])->name('requests.show');
Route::post('/requests/{id}/checkin', [TravelRequestController::class, 'checkin'])->name('requests.checkin');

Route::get('/approvals', [UserApprovalController::class, 'index'])->name('approvals.index');

Route::get('/settlements', [UserSettlementController::class, 'index'])->name('settlements.index');
Route::post('/settlements', [UserSettlementController::class, 'store'])->name('settlements.store');

Route::get('/support', function () {
    return view('support.index');
})->name('support.index');

Route::get('/settings', [UserSettingsController::class, 'index'])->name('settings.index');
Route::post('/settings', [UserSettingsController::class, 'update'])->name('settings.update');

// ==========================================
// 2. Modul Atasan (Approver)
// ==========================================
Route::prefix('approver')->name('approver.')->group(function () {
    Route::get('/dashboard', [ApprovalController::class, 'index'])->name('dashboard');
    Route::get('/requests', [ApprovalController::class, 'index'])->name('requests');
    Route::get('/requests/{id?}', [ApprovalController::class, 'show'])->name('requests.show');
    Route::get('/delegation', [ApprovalController::class, 'delegation'])->name('delegation');
});

// ==========================================
// 3. Modul Admin Travel (Travel Desk)
// ==========================================
Route::prefix('travel-admin')->name('travel-admin.')->group(function () {
    Route::get('/dashboard', [TravelAdminController::class, 'index'])->name('dashboard');
    Route::get('/bookings', [TravelAdminController::class, 'index'])->name('bookings');
    Route::get('/bookings/{id?}', [TravelAdminController::class, 'show'])->name('bookings.show');
    Route::get('/vendors', [TravelAdminController::class, 'vendors'])->name('vendors');
});

// ==========================================
// 4. Modul Tim Keuangan (Finance)
// ==========================================
Route::prefix('finance')->name('finance.')->group(function () {
    Route::get('/dashboard', [FinanceController::class, 'index'])->name('dashboard');
    Route::get('/cash-advances', [FinanceController::class, 'cashAdvances'])->name('cash-advances');
    Route::get('/settlements', [FinanceController::class, 'settlements'])->name('settlements');
    Route::get('/settlements/{id?}', [FinanceController::class, 'reviewSettlement'])->name('settlements.review');
    Route::get('/reports', [FinanceController::class, 'reports'])->name('reports');
});

// ==========================================
// 5. Modul Super Admin
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/policies', [AdminController::class, 'policies'])->name('policies');
    Route::get('/audit-logs', [AdminController::class, 'auditLogs'])->name('audit-logs');
});

// Profile Management (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
