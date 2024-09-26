<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use App\Models\riwayat_kendaraan;
use App\Models\User;
use App\Models\driver;
use App\Models\pemesanan;
use App\Models\jadwalService;
use App\Models\pinjaman;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class MonitorController extends Controller
{

    public function index()
    {
        $riwayat = DB::table('riwayat_kendaraans')
            ->select('tanggal', DB::raw('SUM(konsumsi_bbm) as total_konsumsi_bbm'))
            ->groupBy('tanggal')
            ->get();

        // dd($riwayat);
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

        return redirect('/pengajuan-kendaraan');
    }

    public function pengajuan(Request $request)
    {
        $pengajuan = pemesanan::with('user', 'kendaraan', 'driver')->get();
        $kendaraan = kendaraan::get();
        $driver = driver::get();
        $user = User::get();
        // dd($pengajuan);
        return view('pengajuan', compact('pengajuan', 'kendaraan', 'driver', 'user'));
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
        try {
            DB::beginTransaction();

            $ubahStatus = pemesanan::find($id);
            $ubahStatus->status = $request->inputstatus;
            $ubahStatus->save();

            if ($request->input('inputstatus') === 'disetujui') {
                Pinjaman::create([
                    'id_pemesanan' => $id
                ]);
            }

            //dd($request->all());

            DB::commit();

            return redirect('pengajuan-kendaraan')
                ->with('success', 'Request Berhasil Diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Memproses Request : ' . $e->getMessage());
        }
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

        $currentDate = Carbon::now();
        $formlaporan = pinjaman::select(
            'pinjamen.id as id_pinjam',
            'pemesanans.tanggal_pinjam as pinjam',
            'pemesanans.tanggal_kembali as kembali',
            'kendaraans.id as kendaraan_id',
            'kendaraans.nama as kendaraan',
            'kendaraans.jenis_kendaraan',
            'drivers.nama as nama_driver',
        )
            ->join('pemesanans', 'pemesanans.id', '=', 'pinjamen.id_pemesanan')
            ->join('kendaraans', 'kendaraans.id', '=', 'pemesanans.kendaraan_id')
            ->join('drivers', 'drivers.id', '=', 'pemesanans.driver_id')
            ->where('tanggal_kembali', '<=', $currentDate)
            ->get();
        $kendaraan = kendaraan::get();
        $driver = driver::get();

        //dd($formlaporan);

        return view('laporan_kendaraan', compact('laporan', 'kendaraan', 'driver', 'formlaporan'));
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
            'id_pinjam' => $request->inputIdPinjam,
            'konsumsi_bbm' => $request->inputbbm,
            'tanggal' => $request->inputTanggal,
        ]);

        return redirect('/laporan-kendaraan');
    }

    // jadwal service
    public function jadwalService()
    {
        $currentDate = Carbon::now();
        $jadwal = jadwalService::with('kendaraan')->orderBy('jadwal_service')->where('jadwal_service','>=',$currentDate)->get();
        $kendaraan = kendaraan::get();
        //dd($jadwal);
        return view('jadwal_service', compact('jadwal', 'kendaraan'));
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
}
