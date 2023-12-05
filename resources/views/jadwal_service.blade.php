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
    <a href="/">dashboard</a>
    <a href="/tambah_jadwal">Tambah Jadwal Service</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">NO Laporan</th>
                <th scope="col">Kendaraan</th>
                <th scope="col">Jadwal Service</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($laporan as $list)
                <tr>
                    <th scope="row">{{ $list->id }}</th>
                    <td>{{ $list->kendaraan->nama }}</td>
                    <td>{{ $list->konsumsi_bbm }}</td>
                    <td>{{ $list->driver }}</td>
                    <td>{{ $list->created_at }}</td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
