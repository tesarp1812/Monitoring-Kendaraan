<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    {{-- form --}}
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Form Pengajuan Kendaraan</h2>
                <form action="/simpan" method="POST">
                    @csrf
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
                        <input type="date" name="inputpinjam">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tanggal Kembali</label>
                        <input type="date" name="inputkembali">
                    </div>
                    <div class="mb-3" hidden>
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="inputstatus">
                            <option value="belum setujui">Belum Disetujui</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/">dashboard</a>
                </form>
            </div>
        </div>
    </div>
    {{-- end form --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
