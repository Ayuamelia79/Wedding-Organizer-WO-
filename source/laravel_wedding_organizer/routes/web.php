<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PengantinAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| Routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// ============================================================================
// ROOT & REDIRECTS
// ============================================================================
Route::get('/', function () {
    if (Auth::check()) {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'pengantin' => redirect()->route('pengantin.dashboard'),
            default => redirect()->route('admin.login'),
        };
    }
    return redirect()->route('admin.login');
})->name('home');

// Public Contact page
Route::get('/hubungi-kami', [ContactController::class, 'show'])->name('contact.show');
Route::post('/hubungi-kami', [ContactController::class, 'store'])->name('contact.store');

// ============================================================================
// ADMIN ROUTES
// ============================================================================
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Admin Authentication (Guest Only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });
    
    // Admin Protected Routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('verified')
            ->name('dashboard');
        
        // Logout
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        
        // Package Management (CRUD)
        Route::resource('paket', PaketController::class);
        
        // Booking Management (CRUD)
        Route::resource('pemesanan', PemesananController::class);
        Route::patch('/pemesanan/{pemesanan}/status', [PemesananController::class, 'updateStatus'])
            ->name('pemesanan.updateStatus');
        
        // Customer Management
        Route::get('/customers', [DashboardController::class, 'customers'])->name('customers.index');
        Route::get('/customers/{user}', [DashboardController::class, 'customerDetail'])->name('customers.show');
        
        // Reports
        Route::get('/reports', [DashboardController::class, 'reports'])->name('reports.index');
        Route::get('/reports/revenue', [DashboardController::class, 'revenueReport'])->name('reports.revenue');
        Route::get('/reports/bookings', [DashboardController::class, 'bookingsReport'])->name('reports.bookings');
    });
});

// ============================================================================
// PENGANTIN (CUSTOMER) ROUTES
// ============================================================================
Route::prefix('pengantin')->name('pengantin.')->group(function () {
    
    // Pengantin Authentication (Guest Only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [PengantinAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [PengantinAuthController::class, 'login']);
        Route::get('/register', [PengantinAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [PengantinAuthController::class, 'register'])->name('register.store');
    });
    
    // Pengantin Protected Routes
    Route::middleware(['auth', 'role:pengantin'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [PengantinAuthController::class, 'dashboard'])->name('dashboard');
        
        // Logout
        Route::post('/logout', [PengantinAuthController::class, 'logout'])->name('logout');
        
        // Browse Packages (View Only)
        Route::get('/paket', [PaketController::class, 'index'])->name('paket.index');
        Route::get('/paket/{paket}', [PaketController::class, 'show'])->name('paket.show');
        
        // My Bookings Management
        Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
        Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
        Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
        Route::get('/pemesanan/{pemesanan}', [PemesananController::class, 'show'])->name('pemesanan.show');
        Route::delete('/pemesanan/{pemesanan}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');
        
        // Profile Management
        Route::get('/profile', [PengantinAuthController::class, 'profile'])->name('profile.index');
        Route::put('/profile', [PengantinAuthController::class, 'updateProfile'])->name('profile.update');
        Route::put('/profile/password', [PengantinAuthController::class, 'updatePassword'])->name('profile.password');
        
        // Payment Tracking
        Route::get('/pembayaran', [PemesananController::class, 'payments'])->name('pembayaran.index');
        Route::get('/pembayaran/{pembayaran}', [PemesananController::class, 'paymentDetail'])->name('pembayaran.show');
        
        // Guest List Management
        Route::get('/tamu', [PemesananController::class, 'guests'])->name('tamu.index');
        Route::post('/tamu', [PemesananController::class, 'addGuest'])->name('tamu.store');
        Route::delete('/tamu/{tamu}', [PemesananController::class, 'removeGuest'])->name('tamu.destroy');
    });
});

// Legacy URL Support - Redirect old dashboard URL
Route::get('/dashboard-pengantin', function () {
    return redirect()->route('pengantin.dashboard');
})->middleware(['auth', 'role:pengantin']);

// ============================================================================
// SHARED AUTHENTICATED ROUTES
// ============================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================================================
// LARAVEL BREEZE AUTH ROUTES
// ============================================================================
require __DIR__.'/auth.php';
