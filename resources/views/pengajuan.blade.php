@extends('index')
@section('body')
    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil!',
                '{{ session('success') }}',
                'success'
            );
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire(
                'Gagal!',
                '{{ session('error') }}',
                'error'
            );
        </script>
    @endif

@section('table')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                List Pengajuan Kendaraan
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formPengajuan">
                    Form Pengajuan Kendaraan
                </button>

                <!-- Modal -->
                <div class="modal fade" id="formPengajuan" tabindex="-1" aria-labelledby="formPengajuanLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="formPengajuanLabel">Pengajuan Kendaraan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/simpan-pemesanan" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Kendaraan</label>
                                        <select class="form-select" aria-label="Default select example" name="inputkendaraan">
                                            <option selected disabled>pilih kendaraan</option>
                                            @foreach ($kendaraan as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Driver</label>
                                        <select class="form-select" aria-label="Default select example" name="inputdriver">
                                            <option selected disabled>pilih driver</option>
                                            @foreach ($driver as $d)
                                                <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Persetujuan</label>
                                        <select class="form-select" aria-label="Default select example" name="inputuser">
                                            <option selected disabled>pilih kepala bagian</option>
                                            @foreach ($user as $user)
                                                @if ($user->role == 'kepala')
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal Pinjam</label>
                                        <input type="date"  class="form-control datepicker" placeholder="Select a date" name="inputpinjam">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tanggal Kembali</label>
                                        <input type="date" class="form-control datepicker" placeholder="Select a date" name="inputkembali">
                                    </div>
                                    <input type="hidden" value="belum setujui" name="inputstatus">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">NO Pemesanan</th>
                                <th scope="col">Kendaraan</th>
                                <th scope="col">Nama Driver</th>
                                <th scope="col">Kepala Bagian</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Tanggal Kembali</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan as $list)
                                @auth
                                    @if (auth()->user()->role == 'admin')
                                        <!-- Jika user adalah admin, tampilkan semua data -->
                                        <tr>
                                            <th scope="row">{{ $list->id }}</th>
                                            <td>{{ $list->kendaraan->nama }}</td>
                                            <td>{{ $list->driver->nama }}</td>
                                            <td>{{ $list->user->name }}</td>
                                            <td>{{ $list->status }}</td>
                                            <td>{{ $list->tanggal_pinjam }}</td>
                                            <td>{{ $list->tanggal_kembali }}</td>
                                            <td>
                                                @if ($list->status === 'belum disetujui')
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#modalAdmin">
                                                        Persetujuan
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modalAdmin" tabindex="-1"
                                                        aria-labelledby="modalAdminLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="modalAdminLabel">
                                                                        Persetujuan
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="update/{{ $list->id }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        Apakah Anda Mensetujui Kendaraan Sesuai Request ?
                                                                        <div class="mb-3">
                                                                            <label for="inputuser" class="form-label"></label>
                                                                            <select class="form-select" name="inputstatus"
                                                                                required>
                                                                                <option selected disabled>Persetujuan</option>
                                                                                <option value="disetujui">Setujui</option>
                                                                                <option value="tidak disetujui">Tidak Setujui
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </td>
                                        </tr>
                                    @elseif(auth()->user()->name === $list->user->name && $list->status !== 'disetujui')
                                        <!-- Jika user bukan admin, tampilkan sesuai dengan nama user dan status -->
                                        <tr>
                                            <th scope="row">{{ $list->id }}</th>
                                            <td>{{ $list->kendaraan->nama }}</td>
                                            <td>{{ $list->driver->nama }}</td>
                                            <td>{{ $list->user->name }}</td>
                                            <td>

                                            </td>
                                            {{-- <td><a href="/ubah_status/{{ $list->id }}">{{ $list->status }}</a></td> --}}
                                        </tr>
                                    @endif
                                @endauth
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
@endsection
