<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SekawanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::controller(loginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::controller(SekawanController::class)->group(function () {
    Route::get('/', 'index')->middleware('auth');
    Route::get('/kendaraan', 'kendaraan')->middleware('auth');
    Route::get('/user', 'user')->middleware('auth');
    Route::get('/pengajuan', 'pengajuan')->middleware('auth');
    //pemesananan kendaraan
    Route::get('/pemesanan', 'pemesanan')->middleware('auth');
    Route::post('/simpan', 'pesanKendaraan')->middleware('auth');
    //ubah status
    Route::get('/ubah_status/{id}', 'ubahStatus')->middleware('auth');
    Route::put('update/{id}', 'updateStatus')->middleware('auth');
    //laporan kendaraan
    Route::get('/laporan_kendaraan', 'laporanKendaraan')->middleware('auth');
    Route::get('/tambah_laporan', 'buatLaporan')->middleware('auth');
    Route::post('/simpan_laporan', 'tambahLaporan')->middleware('auth');
    //jadwal service kendaraan
    Route::get('/jadwal_service', 'jadwalService')->middleware('auth');
    Route::get('/tambah_jadwal', 'tambahJadwal')->middleware('auth');
    Route::post('/simpan_jadwal', 'simpanJadwal')->middleware('auth');
    //riwayat kendaraan
    Route::get('/riwayat_kendaraan', 'riwayatKendaraan')->middleware('auth');
});
