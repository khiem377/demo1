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
// routes/apply.php




// Dashboard route, cần đăng nhập và xác minh email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['guest', 'verified'])->name('dashboard');
// Profile routes (cần đăng nhập)
Route::middleware('guest')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//adminadmin
use App\Http\Controllers\AdminController;


Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/applications', [AdminController::class, 'index'])->name('applications.index');
    Route::get('/applications/{id}', [AdminController::class, 'show'])->name('applications.show');

    Route::resource('jobs', JobController::class);
});



// Load auth routes (login, register, password reset,...)
require __DIR__.'/auth.php';

use App\Http\Controllers\Admin\JobController as AdminJobController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('jobs', AdminJobController::class);
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('applications', App\Http\Controllers\Admin\ApplicationController::class);
});
//doashb


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/applications/{id}', [AdminController::class, 'show'])->name('applications.show');
});


use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // ✅ Về trang chủ
})->name('logout');


//banner
use App\Http\Controllers\BannerController;

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/banners', [BannerController::class, 'index'])->name('admin.banners.index');
    Route::post('/banners', [BannerController::class, 'upload'])->name('admin.banners.upload');
});
Route::delete('/admin/banner/{id}', [App\Http\Controllers\Admin\BannerController::class, 'destroy'])->name('admin.banner.destroy');




Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Các route khác...
    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::post('/banners/upload', [BannerController::class, 'upload'])->name('banners.upload');
    Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');
});
Route::delete('admin/banners/{id}', [BannerController::class, 'destroy'])->name('admin.banners.destroy');

//tích hợp mô tả 
Route::post('/jobs/save', [JobController::class, 'store'])->name('jobs.store');
// clound libary
// routes/web.php
use App\Http\Controllers\JobApplicationController;

Route::post('/apply/{id}', [JobApplicationController::class, 'store'])->name('jobs.apply');


// banner swiper
// routes/web.php


Route::get('/admin/banners', [BannerController::class, 'index'])->name('admin.banners.index');
Route::post('/admin/banners/upload', [BannerController::class, 'upload'])->name('admin.banners.upload');
Route::delete('/admin/banners/{id}', [BannerController::class, 'destroy'])->name('admin.banners.destroy');

//admin hrmail
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function() {
    Route::resource('hr_contacts', App\Http\Controllers\Admin\HrContactController::class);
   

});






Route::get('/test-mail-hr', function () {
    $hrEmails = App\Models\HRContact::pluck('email')->toArray();
    foreach ($hrEmails as $email) {
        Mail::raw('Test gửi mail cho HR từ Laravel!', function ($message) use ($email) {
            $message->to($email)->subject('Test mail HR');
        });
    }
    return 'Mail test đã gửi cho HR trong database.';
});
