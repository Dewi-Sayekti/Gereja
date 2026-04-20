<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ========== PUBLIC ROUTES ==========
Route::get('/', [ImageController::class, 'index'])->name('welcome');
Route::get('/history', [PageController::class, 'history'])->name('history');
Route::get('/vision', [PageController::class, 'vision'])->name('vision');
Route::get('/struktur', [PageController::class, 'struktur'])->name('struktur');
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
Route::get('/pengumuman', [PageController::class, 'pengumuman'])->name('pengumuman');
Route::get('/pastors', [PageController::class, 'pastors'])->name('pastors');
Route::get('/gallery', [ImageController::class, 'gallery'])->name('gallery');
Route::get('/image/{id}', [ImageController::class, 'show'])->name('image.detail');

// ========== AUTH ROUTES (Guest) ==========
Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

// ========== PROTECTED ROUTES (Logged In) ==========
Route::middleware('auth')->group(function () {
    
    // DASHBOARD - Diperbaiki agar tidak error Undefined Variable
    Route::get('/dashboard', function () {
        $heroSliders = \App\Models\HeroSlider::all();
        // Mengirim data ke view agar @forelse tidak error
        return view('welcome', compact('heroSliders')); 
    })->name('dashboard');

    // Admin Galeri - Disederhanakan menggunakan Group
    Route::prefix('admin/galeri')->name('admin.galeri.')->group(function () {
        Route::get('/create', [ImageController::class, 'create'])->name('create');
        Route::post('/store', [ImageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ImageController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ImageController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ImageController::class, 'destroy'])->name('delete');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Profile
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});