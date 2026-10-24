<?php
/**
 * File Routes: Mendefinisikan semua rute aplikasi dengan proteksi middleware
 */
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MakananMinumanController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ==================== ROUTE GUEST ====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ==================== ROUTE AUTH ====================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', fn() => redirect()->route('dashboard'));

    // Redirect dashboard sesuai role
    Route::get('/dashboard', function () {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'petugas' => redirect()->route('petugas.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
        };
    })->name('dashboard');

    // ========== ADMIN ONLY ==========
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    });

    // ========== PETUGAS ONLY ==========
    Route::middleware('role:petugas')->group(function () {
        Route::get('/petugas/dashboard', [DashboardController::class, 'petugas'])->name('petugas.dashboard');
    });

    // ========== CUSTOMER ONLY ==========
    Route::middleware('role:customer')->group(function () {
        Route::get('/customer/dashboard', [DashboardController::class, 'customer'])->name('customer.dashboard');
        Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    });

    // ========== ADMIN & PETUGAS ==========
    Route::middleware('role:admin,petugas')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('makanan-minuman', MakananMinumanController::class);
    });

    // ========== SEMUA ROLE (Pengaduan) ==========
    Route::resource('pelayanan', PelayananController::class);
});