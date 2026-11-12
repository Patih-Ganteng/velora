<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\InvitationController;

Route::get('/', function () {
    return view('welcome');
});

// === Rute Google Login (Sesi 2) ===
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

// === Rute Untuk Tamu (TANPA LOGIN) ===
// Ini ditaruh di luar grup auth biar tamu yang nggak punya akun bisa RSVP
Route::post('/undangan/{invitation}/rsvp', [InvitationController::class, 'updateRsvp'])->name('guests.rsvp');

// === Rute Wajib Login (Sesi 3 & 6) ===
Route::middleware('auth')->group(function () {
    
    // 1. Halaman Pilih Paket
    Route::get('/pilih-paket', [PlanController::class, 'index'])->name('plans.index');
    Route::post('/pilih-paket/{plan}', [PlanController::class, 'store'])->name('plans.store');

    // 2. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 3. Buat Undangan
    Route::get('/undangan/buat', [InvitationController::class, 'create'])->name('invitations.create');
    Route::post('/undangan', [InvitationController::class, 'store'])->name('invitations.store');

    // 4. Lihat Undangan (Preview)
    Route::get('/undangan/{invitation}', [InvitationController::class, 'show'])->name('invitations.show');

    // 5. Tambah Tamu (Dari Dashboard)
    Route::post('/undangan/{invitation}/tamu', [InvitationController::class, 'storeGuest'])->name('guests.store');

    Route::post('/undangan/{invitation}/ucapan', [App\Http\Controllers\InvitationController::class, 'storeMessage'])->name('messages.store');

        Route::get('/undangan/{invitation}/edit', [InvitationController::class, 'edit'])->name('invitations.edit');
        Route::post('/undangan/{invitation}/update', [InvitationController::class, 'update'])->name('invitations.update');
 
            // Rute Transaksi
    Route::get('/transaksi', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
            // Rute Daftar Semua Undangan
    Route::get('/daftar-undangan', [InvitationController::class, 'index'])->name('invitations.index');
            // Rute Customer Service
    Route::get('/customer-service', function () {
        return view('customer-service');
    })->name('customer-service');
            // Rute untuk melihat daftar tamu
 
                // Rute Logout
    Route::post('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
            
            
Route::get('/undangan/{invitation}/daftar-tamu', [InvitationController::class, 'guests'])->name('invitations.guests');
      // Rute Hapus Tamu (Ini yang tadi hilang)
    Route::delete('/undangan/{invitation}/tamu/{guestId}', [InvitationController::class, 'destroyGuest'])->name('guests.destroy');
});