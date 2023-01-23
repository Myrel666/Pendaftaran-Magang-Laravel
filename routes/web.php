<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminController;
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
Route::get('daftar/divisi/{user}/{durasi}', [GuestController::class, 'divisiPendaftaran'])->name('guest.pendaftaran.divisi');
Route::get('daftar/{divisi}/{user}/{durasi}', [GuestController::class, 'pendaftaran'])->name('guest.pendaftaran');
Route::post('daftar/formulir', [GuestController::class, 'formulir'])->name('guest.formulir');


// Authentication
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login/auth', [LoginController::class, 'authenticate'])->name('auth');
Route::get('home', [AdminController::class, 'index'])->name('home');

// Administrator
// Durasi
Route::get('admin/durasi/{user?}', [AdminController::class, 'durasi'])->name('admin.durasi');
Route::post('admin/durasi/add', [AdminController::class, 'addDurasi'])->name('admin.durasi.add');
Route::get('admin/durasi/show/{id}', [AdminController::class, 'showDurasi'])->name('admin.durasi.show');
Route::put('admin/durasi/updateStatus', [AdminController::class, 'updateStatusDurasi'])->name('admin.durasi.updateStatus');
Route::get('admin/durasi/delete/{durasi}', [AdminController::class, 'deleteDurasi'])->name('admin.durasi.delete');

// Divisi
Route::get('admin/divisi', [AdminController::class, 'divisi'])->name('admin.divisi');
Route::get('admin/divisi/show/{id}', [AdminController::class, 'showDivisi'])->name('admin.divisi.show');
Route::post('admin/divisi/add', [AdminController::class, 'addDivisi'])->name('admin.divisi.add');
Route::get('admin/divisi/delete/{divisi}', [AdminController::class, 'deleteDivisi'])->name('admin.divisi.delete');


// Pemagang
Route::get('admin/pemagang', [AdminController::class, 'pemagang'])->name('admin.pemagang');
Route::get('admin/pemagang/show/{id}', [AdminController::class, 'showPemagang'])->name('admin.pemagang.show');
Route::post('admin/pemagang/add', [AdminController::class, 'addOrUpdatePemagang'])->name('admin.pemagang.add');
Route::get('admin/pemagang/delete/{id}', [AdminController::class, 'deletePemagang'])->name('admin.pemagang.delete');


// Forgot Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
