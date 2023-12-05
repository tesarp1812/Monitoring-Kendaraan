<?php

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

Route::controller(SekawanController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/kendaraan', 'kendaraan');
    Route::get('/user', 'user');
    Route::get('/pengajuan', 'pengajuan');
    //pemesananan kendaraan
    Route::get('/pemesanan', 'pemesanan');
    Route::post('/simpan', 'pesanKendaraan');
    //ubah status
    Route::get('/ubah_status/{id}', 'ubahStatus');
    Route::put('update/{id}', 'updateStatus');
    //laporan kendaraan
    Route::get('/laporan_kendaraan', 'laporanKendaraan');
    Route::get('/tambah_laporan', 'buatLaporan');
    Route::post('/simpan_laporan', 'tambahLaporan');
    //jadwal service kendaraan
    Route::get('/jadwal_service', 'jadwalService');
    Route::get('/tambah_jadwal', 'tambahJadwal');
});
