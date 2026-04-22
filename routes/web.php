<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\GuestBookController;
use Illuminate\Support\Facades\Route;

// Client (public)
Route::get('/', [GuestBookController::class, 'showForm'])->name('guestbook.form');
Route::post('/guestbook', [GuestBookController::class, 'submit'])->name('guestbook.submit');

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('guests', GuestController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});
