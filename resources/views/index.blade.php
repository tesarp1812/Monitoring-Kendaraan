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

    <div class="container">
        <div class="position-relative">
            <ul>
                <a href="/pemesanan">Pengajuan Kendaraan</a>
            </ul>
            <ul>
                <a href="/pengajuan">list pengajuan</a>
            </ul>
            <ul>
                <a href="/laporan_kendaraan">Pelaporan Kendaraan</a>
            </ul>
            <ul>
                <a href="/jadwal_service">Jadwal Kendaraan Service</a>
            </ul>
        </div>

    </div>

    <div>
        <h2>Total Konsumsi BBM Per Hari</h2>
        <canvas id="myChart1"></canvas>
    </div>
    <div>
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
