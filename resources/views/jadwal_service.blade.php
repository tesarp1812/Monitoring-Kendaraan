@extends('layouts.index')
@section('body')
@section('table')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Jadwal Service Kendaraan
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                @auth
                    @if (auth()->user()->role == 'admin')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tambah Jadwal Service
                        </button>
                    @endif
                @endauth

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Laporan Kendaraan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/simpan_jadwal" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Kendaraan</label>
                                        <select class="form-select" aria-label="Default select example" name="inputkendaraan">
                                            <option selected disabled>pilih kendaraan</option>
                                            @foreach ($kendaraan as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jadwal Service</label>
                                        <input type="date" class="form-control" name="inputjadwal" required>
                                    </div>
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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">NO Laporan</th>
                                <th scope="col">Kendaraan</th>
                                <th scope="col">Jenis Kendaraan</th>
                                <th scope="col">Jadwal Service</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal as $list)
                                <tr>
                                    <th scope="row">{{ $list->id }}</th>
                                    <td>{{ $list->kendaraan->nama }}</td>
                                    <td>{{ $list->kendaraan->jenis_kendaraan }}</td>
                                    <td>{{ $list->jadwal_service }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection
