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

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <a href="/">dashboard</a>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">NO Pemesanan</th>
                            <th scope="col">Kendaraan</th>
                            <th scope="col">Nama Driver</th>
                            <th scope="col">Kepala Bagian</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                        <td><a href="/ubah_status/{{ $list->id }}">{{ $list->status }}</a></td>
                                    </tr>
                                @elseif(auth()->user()->name === $list->user->name && $list->status !== 'disetujui')
                                    <!-- Jika user bukan admin, tampilkan sesuai dengan nama user dan status -->
                                    <tr>
                                        <th scope="row">{{ $list->id }}</th>
                                        <td>{{ $list->kendaraan->nama }}</td>
                                        <td>{{ $list->driver->nama }}</td>
                                        <td>{{ $list->user->name }}</td>
                                        <td><a href="/ubah_status/{{ $list->id }}">{{ $list->status }}</a></td>
                                    </tr>
                                @endif
                            @endauth
                        @endforeach
                    </tbody>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
