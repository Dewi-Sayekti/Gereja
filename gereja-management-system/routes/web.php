<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\JemaatController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Jemaat Routes
    Route::get('/profile', [JemaatController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [JemaatController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [JemaatController::class, 'update'])->name('profile.update');
    
    
    // Keuangan Routes (Admin/Pendeta only)
    Route::middleware('admin')->group(function () {
        Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
        Route::get('/keuangan/create', [KeuanganController::class, 'create'])->name('keuangan.create');
        Route::post('/keuangan', [KeuanganController::class, 'store'])->name('keuangan.store');
        Route::get('/keuangan/{id}/edit', [KeuanganController::class, 'edit'])->name('keuangan.edit');
        Route::put('/keuangan/{id}', [KeuanganController::class, 'update'])->name('keuangan.update');
    });
    
    // Notifikasi Routes
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/baca', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.read');
});