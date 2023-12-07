<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use App\Models\riwayat_kendaraan;
use App\Models\User;
use App\Models\driver;
use App\Models\pemesanan;
use App\Models\jadwalService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class SekawanController extends Controller
{

    public function index()
    {
        $riwayat = DB::table('riwayat_kendaraans')
            ->select('tanggal', DB::raw('SUM(konsumsi_bbm) as total_konsumsi_bbm'))
            ->groupBy('tanggal')
            ->get();

        $data = DB::table('riwayat_kendaraans')
            ->select('tanggal', DB::raw('COUNT(id_pinjam) as total_kendaraan'))
            ->groupBy('tanggal')
            ->get();

        //dd($data);
        return view('index', compact('riwayat', 'data'));
    }

    public function kendaraan()
    {
        $kendaraan = Kendaraan::get();
        $riwayat = riwayat_kendaraan::get();
        //dd($riwayat);

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
        $kendaraan = kendaraan::get();
        $driver = driver::get();
        $user = User::get();
        $pemesanan = pemesanan::get();

        //dd($kendaraan);

        return view('pemesanan', compact('kendaraan', 'driver', 'user', 'pemesanan'));
    }

    public function pesanKendaraan(Request $request)
    {
        //dd($request->all());
        pemesanan::create([
            'kendaraan_id' => $request->inputkendaraan,
            'driver_id' => $request->inputdriver,
            'user_id' => $request->inputuser,
            'status' => $request->inputstatus,
            'tanggal_pinjam' => $request->inputpinjam,
            'tanggal_kembali' => $request->inputkembali,
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
        $ubahStatus = pemesanan::with('kendaraan', 'driver', 'user')->where('id', $id)->first();
        //dd($ubahStatus);
        return view('ubah_Status', ['ubahStatus' => $ubahStatus]);
    }

    // ubah status kendaraan
    public function updateStatus(Request $request, $id)
    {
        //dd($request->all());
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
        $laporan = riwayat_kendaraan::select(
            'riwayat_kendaraans.id',
            'riwayat_kendaraans.konsumsi_bbm',
            'riwayat_kendaraans.tanggal',
            'kendaraans.nama',
            'kendaraans.jenis_kendaraan',
            'drivers.nama as nama_driver',
            'users.name'
        )
            ->join('pinjamen', 'pinjamen.id', '=', 'riwayat_kendaraans.id_pinjam')
            ->join('pemesanans', 'pemesanans.id', '=', 'pinjamen.id_pemesanan')
            ->join('kendaraans', 'kendaraans.id', '=', 'pemesanans.kendaraan_id')
            ->join('drivers', 'drivers.id', '=', 'pemesanans.driver_id')
            ->join('users', 'users.id', '=', 'pemesanans.user_id')
            ->get();
        //dd($laporan);
        return view('laporan_kendaraan', compact('laporan'));
    }

    public function buatLaporan(Request $request)
    {
        $kendaraan = kendaraan::get();
        $driver = driver::get();

        return view('tambah_laporan', compact('kendaraan', 'driver'));
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
        $jadwal = jadwalService::with('kendaraan')->get();
        //dd($jadwal);
        return view('jadwal_service', compact('jadwal'));
    }

    public function tambahJadwal()
    {
        $kendaraan = kendaraan::get();

        return view('tambah_jadwal', compact('kendaraan'));
    }

    public function simpanJadwal(Request $request)
    {
        //dd($request->all());
        jadwalService::create([
            'kendaraan_id' => $request->inputkendaraan,
            'jadwal_service' => $request->inputjadwal
        ]);


        return redirect('/jadwal_service');
    }

    //riwayat kendaraan
    // public function riwayatKendaraan()
    // {
    //     $riwayat = riwayat_kendaraan::with('pinjaman')->get();
    //     //dd($riwayat);
    //     return view('riwayat_kendaraan', compact('riwayat'));
    // }
}
