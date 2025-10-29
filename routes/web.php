<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\BoatmanController;
use App\Http\Controllers\Admin\RescueController;
use App\Http\Controllers\Admin\BoatController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PublicBookingController;

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Guest Routes
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/packages/{package}', [App\Http\Controllers\PackageController::class, 'show'])->name('packages.show');
Route::get('/booking/{package}', [App\Http\Controllers\PublicBookingController::class, 'create'])->name('public.booking.create');
Route::post('/booking/{package}', [App\Http\Controllers\PublicBookingController::class, 'store'])->name('public.booking.store');

// Profil user
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Role-based Dashboard Routes
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/boatman/dashboard', [DashboardController::class, 'boatmanDashboard'])->name('boatman.dashboard')->middleware('role:boatman');
    Route::get('/rescue/dashboard', [DashboardController::class, 'rescueDashboard'])->name('rescue.dashboard')->middleware('role:rescue');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
        Route::resource('packages', \App\Http\Controllers\Admin\PackageController::class);
        Route::resource('boats', \App\Http\Controllers\Admin\BoatController::class);
        Route::resource('boatmen', \App\Http\Controllers\Admin\BoatmanController::class);
        Route::resource('rescue-team', \App\Http\Controllers\Admin\RescueController::class);
        Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class);
        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });

    // Boatman Routes
    Route::middleware(['role:boatman'])->prefix('boatman')->group(function () {
        Route::get('/schedule', 'BoatmanController@schedule')->name('boatman.schedule');
        Route::get('/orders', 'BoatmanController@orders')->name('boatman.orders');
    });

    // Rescue Routes
    Route::middleware(['role:rescue'])->prefix('rescue')->group(function () {
        Route::get('/alerts', 'RescueController@alerts')->name('rescue.alerts');
        Route::get('/equipment', 'RescueController@equipment')->name('rescue.equipment');
    });
});
