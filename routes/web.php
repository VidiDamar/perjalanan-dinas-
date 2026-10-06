<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('requests.index');
});

Route::get('/requests', function () {
    return view('requests.index');
})->name('requests.index');

Route::get('/requests/create', function () {
    return view('requests.create');
})->name('requests.create');

Route::get('/requests/TRQ-2023-0891', function () {
    return view('requests.show');
})->name('requests.show');

Route::get('/approvals', function () {
    return view('approvals.index');
})->name('approvals.index');

Route::get('/settlements', function () {
    return view('settlements.index');
})->name('settlements.index');

Route::get('/support', function () {
    return view('support.index');
})->name('support.index');

Route::get('/settings', function () {
    return view('settings.index');
})->name('settings.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
