<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/resend-otp', [UserController::class, 'resendOTP']);
Route::post('/verify-otp', [UserController::class, 'verifyOTP']);

Route::get('/daftar-kegiatan', [EventController::class, 'index']);
Route::get('/donasi', [EventController::class, 'index']);
Route::get('/donasiLimited', [EventController::class, 'getEventLimited']);
Route::get('/donasi/{id}', [EventController::class, 'getDataById']);
Route::post('/daftar-kegiatan/buat-kegiatan-baru', [EventController::class, 'store']);
Route::put('/daftar-kegiatan/edit-kegiatan/{id_kegiatan}', [EventController::class, 'update']);
Route::delete('/daftar-kegiatan/hapus-kegiatan/{id_kegiatan}', [EventController::class, 'destroy']);

Route::get('/transaksi-donasi', [DonationController::class, 'index']);
Route::get('/ringkasan-donasi/{id_donasi}', [DonationController::class, 'viewDetailDonation']);
Route::put('/verifikasi-donasi/{id_donasi}', [DonationController::class, 'verifyDonation']);
Route::post('/send-donation-receipt/{id_donasi}', [UserController::class, 'sendDonationReceipt']);

Route::post('/upload', [FileUploadController::class, 'upload']);
