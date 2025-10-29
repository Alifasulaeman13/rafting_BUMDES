<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // User endpoints
    Route::middleware('role:user')->group(function () {
        Route::get('/posts', [\App\Http\Controllers\User\PostController::class, 'index']);
        Route::get('/packages', [\App\Http\Controllers\User\PackageController::class, 'index']);
        Route::get('/packages/{package}', [\App\Http\Controllers\User\PackageController::class, 'show']);
        Route::post('/bookings', [\App\Http\Controllers\BookingController::class, 'store']);
        Route::get('/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'show']);
    });

    // Admin endpoints
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('admin/posts', \App\Http\Controllers\Admin\PostController::class);
        Route::apiResource('admin/packages', \App\Http\Controllers\Admin\PackageController::class);
        Route::apiResource('admin/boats', \App\Http\Controllers\Admin\BoatController::class);
        Route::apiResource('admin/operators', \App\Http\Controllers\Admin\OperatorController::class);
        Route::apiResource('admin/rescue', \App\Http\Controllers\Admin\RescueController::class);
        Route::get('admin/reports/bookings', [\App\Http\Controllers\Admin\ReportController::class, 'bookings']);
        Route::get('admin/reports/orders', [\App\Http\Controllers\Admin\ReportController::class, 'orders']);
        Route::post('admin/config/payment', [\App\Http\Controllers\Admin\ConfigController::class, 'payment']);
        Route::post('admin/seed/demo', [\App\Http\Controllers\Admin\SeedController::class, 'seedDemo']);
    });

    // OjekPerahu endpoints
    Route::middleware('role:ojek_perahu')->group(function () {
        Route::get('operator/dashboard', [\App\Http\Controllers\OjekPerahu\DashboardController::class, 'index']);
        Route::get('operator/tasks', [\App\Http\Controllers\OjekPerahu\DashboardController::class, 'tasks']);
    });

    // Rescue endpoints
    Route::middleware('role:rescue')->group(function () {
        Route::get('rescue/dashboard', [\App\Http\Controllers\Rescue\DashboardController::class, 'index']);
        Route::get('rescue/notifications', [\App\Http\Controllers\NotificationController::class, 'poll']);
        Route::post('rescue/confirm', [\App\Http\Controllers\Rescue\DashboardController::class, 'confirmReady']);
        Route::post('rescue/complete/{order}', [\App\Http\Controllers\Rescue\DashboardController::class, 'markComplete']);
    });

    // Rotation & Orders
    Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store']);
    Route::post('/rotation/assign/{order}', [\App\Http\Controllers\RotationController::class, 'assign']);

    // Payment
    Route::post('/payment/intent/{booking}', [\App\Http\Controllers\PaymentController::class, 'createIntent']);
    Route::post('/payment/webhook', [\App\Http\Controllers\PaymentController::class, 'webhook']);
    Route::get('/payment/status/{booking}', [\App\Http\Controllers\PaymentController::class, 'status']);
});