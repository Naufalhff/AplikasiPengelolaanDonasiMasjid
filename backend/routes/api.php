<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register/{selected_role}', [UserController::class, 'registerCache']);
Route::post('/save-account', [UserController::class, 'saveCache']);
Route::post('/resend-otp', [UserController::class, 'resendOTP']);
Route::post('/verify-otp', [UserController::class, 'verifyOTP']);
Route::post('/send-reset', [UserController::class, 'sendReset']);
Route::put('/reset-password', [UserController::class, 'resetPassword']);

Route::get('/daftar-kegiatan', [EventController::class, 'index']);
Route::get('/donasi', [EventController::class, 'index']);
Route::get('/donasiLimited', [EventController::class, 'getEventLimited']);
Route::get('/donasi/{id}', [EventController::class, 'getDataById']);
Route::get('/jumlah_donatur/{id}', [EventController::class, 'countDonatur']);
Route::patch('/update-anggaran-terkumpul/{id}', [EventController::class, 'updateAmount']);
Route::post('/buat-kegiatan', [EventController::class, 'store']);
Route::put('/edit-kegiatan/{id_kegiatan}', [EventController::class, 'update']);
Route::delete('/hapus-kegiatan', [EventController::class, 'destroy']);

Route::get('/donasi-terakhir', [DonationController::class, 'getLimitedDonasi']);
Route::get('/total-donasi', [DonationController::class, 'getTotalDonation']);
Route::get('/jumlah-donasi', [DonationController::class, 'countDonation']);
Route::get('/transaksi-donasi', [DonationController::class, 'index']);
Route::get('/ringkasan-donasi/{id_donasi}', [DonationController::class, 'viewDetailDonation']);
Route::put('/verifikasi-donasi/{id_donasi}', [DonationController::class, 'verifyDonation']);
Route::post('/send-donation-receipt/{id_donasi}', [UserController::class, 'sendDonationReceipt']);

Route::get('/informasi-statistik', [DashboardController::class, 'getStatistics']);
Route::get('/donasi-terakhir', [DashboardController::class, 'getLimitedDonasi']);
Route::get('/total-donasi', [DashboardController::class, 'getTotalDonation']);
Route::get('/jumlah-donasi', [DashboardController::class, 'countDonation']);
Route::get('/jumlah-kegiatan', [DashboardController::class, 'countEvent']);
Route::get('/jumlah-donatur', [DashboardController::class, 'countDonatur']);

Route::get('/riwayat-transaksi/{id_kegiatan}', [ExpenseController::class, 'showExpense']);
Route::get('/detail-pengeluaran/{id_pengeluaran}', [ExpenseController::class, 'expenseDetails']);
Route::delete('/hapus-pengeluaran/{id_pengeluaran}', [ExpenseController::class, 'deleteExpense']);

Route::post('/upload', [FileUploadController::class, 'upload']);
Route::post('/tambah-pengeluaran', [FileUploadController::class, 'addExpense']);

Route::get('/getDonasi', [DonationController::class, 'getDonasi']);
Route::get('/getPaymentById/{id}', [PaymentController::class, 'getDataById']);
