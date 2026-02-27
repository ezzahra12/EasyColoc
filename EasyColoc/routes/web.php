<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboardController;


Route::view('/', 'welcome');

Route::get('/dashboard', [ColocationController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';



// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->name('logout');


Route::middleware(['auth'])->group(function () {
    // Page profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Page modification mot de passe
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Vérification email (si non déjà incluse)
    Route::post('/email/verification-notification', [ProfileController::class, 'sendVerificationEmail'])->name('verification.send');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    // nouvelle colocation
    Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocations.create');

    // Stocker la nouvelle colocation
    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');
});

Route::get('/dashboard/{colocation}', [DashboardController::class, 'show'])
    ->middleware('auth')
    ->name('dashboard.show');


 Route::get('/colocations/{colocation}', [DashboardController::class, 'show'])->name('colocations.show');
