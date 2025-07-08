<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Data Balita</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        hr {
            height: 2px;
            background-color: black;
            border: none;
        }

        .container {
            width: 70%;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        #keterangan tr td:first-child {
            width: 150px;
        }

        #pesanan {
            border-collapse: collapse;
            margin: 0 50px;
            width: 90%;
        }

        #pesanan td,
        #pesanan th {
            border: 1px solid black;
            padding: 8px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            padding: 10px;
            min-width: 300px; /* Ensure charts don’t get too small on narrow screens */
        }

        canvas.chart {
            margin: 20px auto;
            max-width: 100%;
            width: 100% !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center">PUSKESMAS WUNDULAKO</h3>
        <hr>
        <h5 class="text-center"><u>Laporan Gizi Balita</u></h5>

        <table id="pesanan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Waktu Pemeriksaan</th>
                    <th>Umur (Bulan)</th>
                    <th>Berat (Kg)</th>
                    <th>Tinggi (Cm)</th>
                    <th>Status Gizi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan_gizi as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->umur }}</td>
                        <td>{{ $item->berat }}</td>
                        <td>{{ $item->tinggi }}</td>
                        <td>{{ $item->status_gizi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Grafik -->
        @if($balita)
            <div class="row">
                <!-- Grafik Berat Badan -->
                <div class="col">
                    <canvas id="kms-chart-weight" class="chart" height="400"></canvas>
                </div>
                <!-- Grafik Tinggi Badan -->
                <div class="col">
                    <canvas id="kms-chart-height" class="chart" height="400"></canvas>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Grafik Berat Badan
                    const ctxWeight = document.getElementById('kms-chart-weight').getContext('2d');
                    const anakDataWeight = {!! json_encode(
                        \App\Models\RiwayatPemeriksaan::where('id_balita', $balita->id)
                            ->where('umur', '<=', 60)
                            ->orderBy('umur', 'asc')
                            ->get()
                            ->map(fn ($item) => ['x' => (float) $item->umur, 'y' => (float) $item->berat])
                            ->toArray()
                    ) !!};

                    const whoDataWeight = {!! json_encode(
                        \App\Models\StandarBeratWho::all()->toArray()
                    ) !!};
                    const labelsWeight = whoDataWeight.map(item => parseFloat(item.bulan));

                    const sdLabels = ['SD-3', 'SD-2', 'SD-1', 'SD 0', 'SD +1', 'SD +2', 'SD +3'];
                    const sdColors = ['black', 'orange', 'black', 'green', 'orange', 'black', 'black'];
                    const sdFieldsWeight = ['SD3neg', 'SD2neg', 'SD1neg', 'SD0', 'SD1', 'SD2', 'SD3'];

                    const datasetsWeight = [
                        {
                            label: 'Data Berat',
                            data: anakDataWeight,
                            backgroundColor: 'black',
                            borderColor: 'black',
                            fill: false,
                            pointRadius: 4
                        },
                        ...sdLabels.map((label, index) => ({
                            label: label,
                            data: whoDataWeight.map(item => parseFloat(item[sdFieldsWeight[index]])),
                            borderColor: sdColors[index],
                            backgroundColor: 'transparent',
                            borderWidth: 1,
                            pointRadius: 0,
                            tension: 0.4
                        }))
                    ];

                    new Chart(ctxWeight, {
                        type: 'line',
                        data: {
                            labels: labelsWeight,
                            datasets: datasetsWeight
                        },
                        options: {
                            plugins: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: 'Berat Badan Menurut Umur',
                                    font: { size: 16 }
                                }
                            },
                            scales: {
                                x: { title: { display: true, text: 'Umur (Bulan)' } },
                                y: { title: { display: true, text: 'Berat Badan (Kg)' } }
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });


                    // Grafik Berat Badan
                    const ctxHeigth = document.getElementById('kms-chart-height').getContext('2d');
                    const anakDataHeight = {!! json_encode(
                        \App\Models\RiwayatPemeriksaan::where('id_balita', $balita->id)
                            ->where('umur', '<=', 60)
                            ->orderBy('umur', 'asc')
                            ->get()
                            ->map(fn ($item) => ['x' => (float) $item->umur, 'y' => (float) $item->tinggi])
                            ->toArray()
                    ) !!};

                    const datasetsHeight = [
                        {
                            label: 'Data Berat',
                            data: anakDataHeight,
                            backgroundColor: 'black',
                            borderColor: 'black',
                            fill: false,
                            pointRadius: 4
                        },
                        ...sdLabels.map((label, index) => ({
                            label: label,
                            data: whoDataWeight.map(item => parseFloat(item[sdFieldsWeight[index]])),
                            borderColor: sdColors[index],
                            backgroundColor: 'transparent',
                            borderWidth: 1,
                            pointRadius: 0,
                            tension: 0.4
                        }))
                    ];

                    new Chart(ctxHeigth, {
                        type: 'line',
                        data: {
                            labels: labelsWeight,
                            datasets: datasetsHeight
                        },
                        options: {
                            plugins: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: 'Tinggi Badan Menurut Umur',
                                    font: { size: 16 }
                                }
                            },
                            scales: {
                                x: { title: { display: true, text: 'Umur (Bulan)' } },
                                y: { title: { display: true, text: 'Tinggi Badan (Kg)' } }
                            },
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                });
            </script>
        @endif

        <div class="row">
            <div class="col"></div>
            <div class="col" style="text-align: center;"></div>
        </div>
    </div>
</body>
</html>
