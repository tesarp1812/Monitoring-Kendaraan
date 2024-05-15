<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap CSS datatable -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    {{-- boostraps icon cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="d-flex flex-column min-vh-100">
    {{-- navbar --}}
    <nav class="navbar navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-truck"> Monitoring Kendaraan</i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- navbar --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        {{-- sidebar button --}}
                        <button class="btn" style="background-color: #e3f2fd;" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop"
                            aria-controls="staticBackdrop">Menu</button>
                    </li>


                    <li class="nav-item dropdown">
                        <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu">
                            <li><a class="dropdown-item disabled" href="#"><i class="bi bi-person-fill">
                                        {{ auth()->user()->name }} -
                                        {{ auth()->user()->role }}</i></a></li>

                            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-house"> Dashboard</i></a>
                            </li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right">
                                        Logout</i></button>
                            </form>

                        </ul>
                    </li>
            </div>
            @yield('navbar-content') <!-- Yield for Navbar Content -->
        </div>
    </nav>


    <div class="offcanvas offcanvas-start" style="background-color: #e3f2fd;" data-bs-scroll="true" tabindex="-1"
        id="staticBackdrop" aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticBackdropLabel">Backdrop with scrolling</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div class="dropdown mt-3">
                <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <a class="btn" style="background-color: #e3f2fd;" href="/">Dashboard</a>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#dashboard-collapse" aria-expanded="false">
                            Kendaraan
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-4">
                                <li><a href="pengajuan-kendaraan" class="link-dark rounded">Pengajuan Kendaraan</a></li>
                                <li><a href="laporan-kendaraan" class="link-dark rounded">Laporan Kendaraan </a></li>
                                <li><a href="jadwal_service" class="link-dark rounded">Jadwal Service Kendaraan </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="border-top my-3"></li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                            data-bs-target="#account-collapse" aria-expanded="false">
                            {{ auth()->user()->name }} - {{ auth()->user()->role }}
                        </button>
                        <div class="collapse" id="account-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ps-4">
                                <li><a href="/dashboard" class="link-dark rounded">Dashboard</a></li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i
                                                class="bi bi-box-arrow-right">Logout</i></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-8">
                    <h2>Total Konsumsi BBM Per Hari</h2>
                    <canvas id="myChart1"></canvas>
                
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <h2>Total Kendaraan Per Hari</h2>
                    <canvas id="myChart2"></canvas>
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
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // First Chart
        const ctx1 = document.getElementById('myChart1');
        const riwayatArray1 = @json($riwayat->toArray());
        const tanggal1 = riwayatArray1.map(data => data.tanggal);
        const totalKonsumsiBBM1 = riwayatArray1.map(data => data.total_konsumsi_bbm);

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: tanggal1,
                datasets: [{
                    label: 'Konsumsi BBM Perhari',
                    data: totalKonsumsiBBM1,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // second chart
        const ctx = document.getElementById('myChart2');
        const data1 = @json($data->toArray());
        const tanggal2 = data1.map(data => data.tanggal); // Corrected variable name
        const total_kendaraan = data1.map(data => data.total_kendaraan);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: tanggal2, // Corrected variable name
                datasets: [{
                    label: 'Total Kendaraan', // Updated label
                    data: total_kendaraan,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    {{-- datatables --}}
    <div class="container">
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable({
                    dom: 'Blfrtip', // Show buttons and length menu
                    lengthMenu: [
                        [10, 25, 50, 100, -1], // Rows per page options
                        ['10', '25', '50', '100', 'All'] // Labels for the rows per page options
                    ],
                    order: [
                        [0, 'desc']
                    ],
                    buttons: [{
                            extend: 'copy',
                            exportOptions: {
                                columns: ':not(.exclude-export)'
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: ':not(.exclude-export)'
                            }
                        },
                        {
                            extend: 'csv',
                            exportOptions: {
                                columns: ':not(.exclude-export)'
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: ':not(.exclude-export)'
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: ':not(.exclude-export)'
                            }
                        }
                    ]
                });
            });
        </script>
        @yield('table')
    </div>
    {{-- button sidebar --}}
    @yield('body')
</body>

</html>
