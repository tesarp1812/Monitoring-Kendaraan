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

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        @auth
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link disabled" aria-disabled="true">{{ auth()->user()->role }}</a>
                                </li>
                                <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                @endauth
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="position-relative">
            @auth
                @if (auth()->user()->role == 'admin')
                    <ul>
                        <a class="btn btn-primary" href="/pemesanan">Pengajuan Kendaraan</a>
                    </ul>
                @endif
            @endauth
            <ul>
                <a class="btn btn-primary" href="/pengajuan">list pengajuan</a>
            </ul>
            <ul>
                <a class="btn btn-primary" href="/laporan_kendaraan">Pelaporan Kendaraan</a>
            </ul>
            <ul>
                <a class="btn btn-primary" href="/jadwal_service">Jadwal Kendaraan Service</a>
            </ul>
        </div>

    </div>

    <div style="width: 50%; height: 50%;">
        <h2>Total Konsumsi BBM Per Hari</h2>
        <canvas id="myChart1"></canvas>
    </div>
    <div style="width: 50%; height: 50%;">
        <h2>Total Kendaraan Per Hari</h2>
        <canvas id="myChart2"></canvas>
    </div>



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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
