<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- DataTables CSS and JS files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.7/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.js"></script>
    <!-- Bootstrap CSS datatable -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <a href="/">Dashboard</a>
                <a href="/tambah_laporan" class="ms-3">Buat Laporan</a>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- DataTables initialization script -->
    <!-- Memuat jQuery terlebih dahulu -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Kemudian baru memuat script DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'Bfrtip', // Menampilkan tombol pada div dengan class "dt-buttons"
                buttons: [{
                        extend: 'copy', // Tombol Copy to Clipboard
                        exportOptions: {
                            columns: ':not(.exclude-export)'
                        }
                    },
                    {
                        extend: 'excel', // Tombol Export ke Excel
                        exportOptions: {
                            columns: ':not(.exclude-export)'
                        }
                    },
                    {
                        extend: 'csv', // Tombol Export ke CSV
                        exportOptions: {
                            columns: ':not(.exclude-export)'
                        }
                    },
                    {
                        extend: 'pdf', // Tombol Export ke PDF
                        exportOptions: {
                            columns: ':not(.exclude-export)'
                        }
                    },
                    {
                        extend: 'print', // Tombol Print
                        exportOptions: {
                            columns: ':not(.exclude-export)'
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>
