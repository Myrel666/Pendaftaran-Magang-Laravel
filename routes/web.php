<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\UserController;
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
Route::get('daftar/search/{user}/{durasi}', [GuestController::class, 'cariDivisi'])->name('guest.cari.divisi');
Route::get('daftar/{divisi}/{user}/{durasi}', [GuestController::class, 'pendaftaran'])->name('guest.pendaftaran');
Route::post('daftar/formulir', [GuestController::class, 'formulir'])->name('guest.formulir');


// Authentication
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login/auth', [LoginController::class, 'authenticate'])->name('auth');

// Forgot Password
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Administrator
Route::get('home', [AdminController::class, 'index'])->name('admin.beranda');
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

// Pengaturan Formulir
Route::get('admin/divisi/formulir', [AdminController::class, 'divisiFormulir'])->name('admin.divisi.formulir');
Route::post('admin/divisi/formulir/addOrUpdate', [AdminController::class, 'addDivisiFormulir'])->name('admin.divisi.formulir.add');
Route::get('admin/divisi/formulir/show/{id}', [AdminController::class, 'showDivisiFormulir'])->name('admin.divisi.formulir.show');
Route::get('admin/divisi/formulir/delete/{divisi}', [AdminController::class, 'deleteDivisiFormulir'])->name('admin.divisi.formulir.delete');

// Pengajuan
Route::get('admin/pengajuan', [AdminController::class, 'pengajuan'])->name('admin.pengajuan');
Route::get('admin/pengajuan/detail/{id}', [AdminController::class, 'detailPengajuan'])->name('admin.pengajuan.detail');
Route::post('admin/pengajuan/updateStatus/{id}', [AdminController::class, 'updateStatuspengajuan'])->name('admin.pengajuan.changeStatus');
Route::get('admin/pengajuan/log/{id}', [AdminController::class, 'logPengajuan'])->name('admin.pengajuan.log');

// Presensi
Route::get('admin/presensi', [AdminController::class, 'presensi'])->name('admin.presensi');
Route::get('admin/presensi/detail/{id}', [AdminController::class, 'detailPresensi'])->name('admin.presensi.detail');
Route::get('admin/presensi/log/{id}', [AdminController::class, 'logPresensi'])->name('admin.presensi.log');

// Pemagang
Route::get('admin/pemagang', [AdminController::class, 'pemagang'])->name('admin.pemagang');
Route::get('admin/pemagang/show/{id}', [AdminController::class, 'showPemagang'])->name('admin.pemagang.show');
Route::post('admin/pemagang/add', [AdminController::class, 'addOrUpdatePemagang'])->name('admin.pemagang.add');
Route::get('admin/pemagang/delete/{id}', [AdminController::class, 'deletePemagang'])->name('admin.pemagang.delete');


// Pendaftar
Route::get('admin/pendaftar', [AdminController::class, 'pendaftar'])->name('admin.pendaftar');
Route::get('admin/pendaftar/show/{pendaftar}', [AdminController::class, 'showPendaftar'])->name('admin.pendaftar.detail');
Route::post('admin/pendaftar/updateStatus/{id}', [AdminController::class, 'updateStatusPendaftar'])->name('admin.pendaftar.changeStatus');



// User
Route::get('beranda', [UserController::class, 'index'])->name('user.beranda');

// Pengajuan
Route::get('user/pengajuan', [UserController::class, 'pengajuan'])->name('user.pengajuan');
Route::get('user/pengajuan/show/{id}', [UserController::class, 'showPengajuan'])->name('user.pengajuan.show');
Route::post('user/pengajuan/add', [UserController::class, 'addOrUpdatePengajuan'])->name('user.pengajuan.add');
Route::get('user/pengajuan/delete/{pengajuan}', [UserController::class, 'deletePengajuan'])->name('user.pengajuan.delete');

// Absensi
Route::get('time', [UserController::class, 'time'])->name('time');
Route::post('user/absensi', [UserController::class, 'absensi'])->name('user.absensi');
Route::get('user/log-presensi', [UserController::class, 'logPresensi'])->name('user.log');