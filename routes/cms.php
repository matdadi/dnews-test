<?php

use App\Http\Controllers\CMS\AdminController;
use App\Http\Controllers\CMS\Auth\PasswordController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin', 'active'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//    Category Management
    Route::resource('category', \App\Http\Controllers\CMS\CategoryController::class);

//    User Management
    Route::patch('/admin/status-update/{admin}', [AdminController::class, 'status_update'])->name('admin.status-update');
    Route::resource('admin', AdminController::class);
    Route::resource('role', \App\Http\Controllers\CMS\RoleController::class);
    Route::resource('permission', \App\Http\Controllers\CMS\PermissionController::class);

//    Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//    Change Password
    Route::get('/profile/change-password', [PasswordController::class, 'edit'])->name('profile.change-password.edit');
    Route::put('/profile/change-password', [PasswordController::class, 'update'])->name('profile.change-password.update');
});


require __DIR__ . '/auth_cms.php';
