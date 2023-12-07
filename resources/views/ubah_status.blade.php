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
                <form action="/update/{{ $ubahStatus->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kendaraan</label>
                        <input class="form-control" type="text" placeholder="Disabled input"
                            aria-label="Disabled input example" value="{{ $ubahStatus->kendaraan->nama }}"
                            name="inputkendaraan" disabled>
                        <input type="text" value="{{ $ubahStatus->kendaraan_id }}" name="inputkendaraan" hidden>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Driver</label>
                        <input class="form-control" type="text" placeholder="Disabled input"
                            aria-label="Disabled input example" value="{{ $ubahStatus->driver->nama }}"
                            name="inputdriver" disabled>
                        <input type="text" value="{{ $ubahStatus->driver_id }}" name="inputdriver" hidden>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Persetujuan</label>
                        <input class="form-control" type="text" placeholder="Disabled input"
                            aria-label="Disabled input example" value="{{ $ubahStatus->user->name }}" name="inputuser"
                            disabled>
                        <input type="text" value="{{ $ubahStatus->user_id }}" name="inputuser" hidden>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Status</label>
                        <select class="form-select" aria-label="Default select example" name="inputstatus">
                            <option
                                value="belum disetujui"{{ $ubahStatus->status === 'belum setujui' ? 'selected' : '' }}>
                                Belum Disetujui
                            </option>
                            <option value="disetujui"{{ $ubahStatus->status == 'disetujui' ? 'selected' : '' }}>
                                Disetujui
                            </option>
                            <option
                                value="tidak disetujui"{{ $ubahStatus->status == 'tidak diterima' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/pengajuan">kembali</a>
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
