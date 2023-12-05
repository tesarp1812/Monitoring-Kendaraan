<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use App\Models\riwayat_kendaraan;
use App\Models\User;
use App\Models\pemesanan;
use Illuminate\Http\Request;

class SekawanController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function kendaraan()
    {
        $kendaraan = Kendaraan::get();
        $riwayat = riwayat_kendaraan::get();
        dd($riwayat);

        return view('kendaraan', compact('kendaraan'));
    }

    public function user()
    {
        $user = User::get();
        dd($user);

        return view('user', compact('user'));
    }

    public function pemesanan()
    {
        return view('pemesanan');
    }

    public function pesanKendaraan(Request $request)
    {
        //dd($request->all());
        pemesanan::create([
            'kendaraan_id' => $request->inputkendaraan,
            'driver_id' => $request->inputdriver,
            'user_id' => $request->inputuser,
            'status' => $request->inputstatus
        ]);

        return redirect('/');
    }

    public function pengajuan(Request $request)
    {
        $pengajuan = pemesanan::with('user', 'kendaraan', 'driver')->get();
        //dd($pengajuan);
        return view('pengajuan', compact('pengajuan'));
    }

    public function ubahStatus($id)
    {
        $ubahStatus = pemesanan::where('id', $id)->first();
        // /dd($ubahStatus);
        return view('ubah_Status', ['ubahStatus' => $ubahStatus]);
    }

    // ubah status kendaraan
    public function updateStatus(Request $request, $id)
    {
        $ubahStatus = pemesanan::find($id);
        $ubahStatus->kendaraan_id = $request->inputkendaraan;
        $ubahStatus->driver_id = $request->inputdriver;
        $ubahStatus->user_id = $request->inputuser;
        $ubahStatus->status = $request->inputstatus;
        $ubahStatus->save();
        return redirect('pengajuan');
    }

    public function laporanKendaraan()
    {
        $laporan = riwayat_kendaraan::with('kendaraan')->get();
        //dd($laporan);
        return view('laporan_kendaraan', compact('laporan'));
    }

    public function buatLaporan(Request $request)
    {
        return view('tambah_laporan');
    }

    public function tambahLaporan(Request $request)
    {
        //dd($request->all());
        riwayat_kendaraan::create([
            'kendaraan_id' => $request->inputkendaraan,
            'konsumsi_bbm' => $request->inputbbm,
            'driver' => $request->inputdriver
        ]);

        return redirect('/laporan_kendaraan');
    }

    // jadwal service
    public function jadwalService()
    {
        return view('jadwal_service');
    }

    public function tambahJadwal()
    {
        return view('tambah_jadwal');
    }
}
