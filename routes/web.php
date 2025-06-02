<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/gioi-thieu', function () {
    return "<h1>Trang Giới thiệu</h1><p>Thông tin về công ty...</p>";
});

Route::get('/vi-tri-ung-tuyen', function () {
    return "<h1>Vị trí ứng tuyển</h1><p>Danh sách các vị trí đang tuyển...</p>";
});

// Job routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{id}/apply', [JobController::class, 'showApplyForm'])->name('jobs.apply.form');
Route::post('/jobs/{id}/apply', [JobController::class, 'apply'])->name('jobs.apply');

// Dashboard route, cần đăng nhập và xác minh email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (cần đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/applications', [AdminController::class, 'index'])->name('admin.applications.index');
    Route::get('/applications/{id}', [AdminController::class, 'show'])->name('admin.applications.show');
});

// Load auth routes (login, register, password reset,...)
require __DIR__.'/auth.php';
