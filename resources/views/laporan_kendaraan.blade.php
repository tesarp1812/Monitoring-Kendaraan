@extends('layouts.index')
@section('body')
@section('table')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                Riwayat Kendaraan
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                @auth
                @if (auth()->user()->role == 'admin')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Laporan
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
                            <form action="/simpan_laporan" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Pilih Kendaraan</label>
                                        <select class="form-select" aria-label="Default select example" name="inputIdPinjam" id="inputIdPinjam">
                                            <option selected disabled>pilih kendaraan</option>
                                            @foreach ($formlaporan as $f)
                                            <option value="{{ $f->id_pinjam }}" data-tanggal="{{$f->kembali}}" >{{$f->nama_driver}} - {{$f->kendaraan}} ({{$f->kembali}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konsumsi BBM</label>
                                        <input type="number" class="form-control" placeholder="konsumsi bbm" name="inputbbm">
                                    </div><div class="mb-3">
                                        <label class="form-label">Tanggal Laporan Kembali</label>
                                        <input type="date" class="form-control" id="tanggal_laporan_disabled" disabled>
                                        <input type="date" class="form-control" id="tanggal_laporan_editable" name="inputTanggal" hidden>
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
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">NO Laporan</th>
                                <th scope="col">Kendaraan</th>
                                <th scope="col">Jenis Kendaraan</th>
                                <th scope="col">Konsumsi BBM</th>
                                <th scope="col">Driver</th>
                                <th scope="col">Persetujuan</th>
                                <th scope="col">Tanggal Kembali</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($laporan as $list)
                                <tr>
                                    <th scope="row">{{ $list->id }}</th>
                                    <td>{{ $list->nama }}</td>
                                    <td>{{ $list->jenis_kendaraan }}</td>
                                    <td>{{ $list->konsumsi_bbm }}</td>
                                    <td>{{ $list->nama_driver }}</td>
                                    <td>{{ $list->name }}</td>
                                    <td>{{ $list->tanggal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
   // Get the dropdown menu element
   var dropdown = document.getElementById("inputIdPinjam");

// Get the tanggal laporan input elements
var tanggalLaporanDisabledInput = document.getElementById("tanggal_laporan_disabled");
var tanggalLaporanEditableInput = document.getElementById("tanggal_laporan_editable");

// Add an onchange event listener to the dropdown
dropdown.addEventListener("change", function() {
    // Get the selected option
    var selectedOption = dropdown.options[dropdown.selectedIndex];
    
    // Get the data-tanggal attribute of the selected option
    var selectedTanggal = selectedOption.getAttribute("data-tanggal");
    
    // Update the value of the tanggal laporan disabled input field
    tanggalLaporanDisabledInput.value = selectedTanggal;

    // Update the value of the tanggal laporan editable input field
    tanggalLaporanEditableInput.value = selectedTanggal;
});
</script>




@endsection
