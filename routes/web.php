<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Guest
Route::get('/', [GuestController::class, 'index'])->name('guest.index');
// Pendaftaran
Route::get('daftar/durasi-magang/{user}', [GuestController::class, 'durasiPendaftaran'])->name('guest.pendaftaran.durasi');
Route::get('daftar/divisi-magang/{user}', [GuestController::class, 'divisiPendaftaran'])->name('guest.pendaftaran.divisi');
Route::get('daftar/divisi/{divisi}/{user}', [GuestController::class, 'pendaftaran'])->name('guest.pendaftaran');


// Authentication
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login/auth', [LoginController::class, 'authenticate'])->name('auth');
Route::get('home', [HomeController::class, 'index'])->name('home');

// Forgot Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
