<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
Route::resource('roles', RoleController::class);
Route::get('/roles/{role}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
Route::post('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
Route::resource('permissions', PermissionController::class);
Route::resource('users', UserController::class);
Route::get('/profile', [SettingController::class, 'showProfile'])->name('profile');
Route::get('/profile/password', [SettingController::class, 'showChangePassword'])->name('profile.password');
Route::post('/profile', [SettingController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/password', [SettingController::class, 'updatePassword'])->name('profile.password.update');
Route::get('/company-settings', [SettingController::class, 'showCompanySettings'])->name('company-settings');
Route::post('/company-settings', [SettingController::class, 'updateCompanySettings'])->name('company-settings.update');
Route::get('/smtp-settings', [SettingController::class, 'showSMTPSettings'])->name('smtp-settings');
Route::post('/smtp-settings', [SettingController::class, 'updateSMTPSettings'])->name('smtp-settings.update');
// });