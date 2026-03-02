<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::view('/', 'welcome');

Route::get('/dashboard', [ColocationController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


Route::post('/colocations/{colocation}/leave', [\App\Http\Controllers\ColocationController::class, 'leave'])
    ->middleware('auth')
    ->name('colocations.leave');

Route::post('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');

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

 Route::post('/colocations/{colocation}/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::get('/colocations/{colocation}/expenses', [ExpenseController::class, 'index'])->name('expenses.index');

// // Invitations
//     Route::post('/invitations/send', [\App\Http\Controllers\InvitationController::class, 'store'])
//         ->name('invitations.send');
    Route::get('/invitations/choose/{token}', [\App\Http\Controllers\InvitationController::class, 'choose'])
        ->name('invitations.choose');
    Route::get('/invitations/accept/{token}', [\App\Http\Controllers\InvitationController::class, 'accept'])
        ->name('invitations.accept');
    Route::get('/invitations/refuse/{token}', [\App\Http\Controllers\InvitationController::class, 'refuse'])
        ->name('invitations.refuse');

        use Illuminate\Support\Facades\Mail;

// Route::get('/test-mail', function () {
//     Mail::raw('EasyColoc test email 🚀', function ($message) {
//         $message->to('test@example.com')
//                 ->subject('Test Email');
//     });

//     return 'Email sent!';
// });

use App\Http\Controllers\InvitationController;

Route::post('/colocation/{colocation}/invite', [InvitationController::class, 'send'])->name('invitations.send');
Route::get('/invitations/respond/{token}/{action}',
    [InvitationController::class, 'respond'])
    ->name('invitations.respond');

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::post('/admin/users/{user}/ban', [UserController::class, 'ban'])
    ->middleware(['auth'])
    ->name('admin.users.ban');

Route::post('/admin/users/{user}/unban', [UserController::class, 'unban'])
    ->middleware(['auth'])
    ->name('admin.users.unban');
