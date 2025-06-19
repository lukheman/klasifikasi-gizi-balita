<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Riwayat Pemeriksaan Balita</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <style>
        hr {
            height: 2px;
            background-color: black;
            border: none;
        }
        .container {
            width: 90%;
            margin: 0 auto;
        }
        .text-center {
            text-align: center;
        }
        #pemeriksaan {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        #pemeriksaan td, #pemeriksaan th {
            border: 1px solid black;
            padding: 8px;
            font-size: 12px;
        }
        #pemeriksaan th {
            background-color: #f2f2f2;
        }
        .filter-info {
            margin-top: 10px;
            font-size: 12px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <h3 class="text-center">PUSKESMAS WUNDULAKO</h3>
        <hr>
        <h5 class="text-center"><u>Laporan Riwayat Pemeriksaan Balita</u></h5>

        <!-- Informasi Filter -->
        <div class="filter-info">
            <p>
                <strong>Filter:</strong>
                Status Gizi: {{ $status_gizi ? implode(', ', array_map(fn($value) => \App\Enums\StatusGizi::from($value)->getLabel(), (array) $status_gizi)) : 'Semua' }} |
                Tanggal: {{ $dari ? \Carbon\Carbon::parse($dari)->format('d/m/Y') : '...' }} - {{ $sampai ? \Carbon\Carbon::parse($sampai)->format('d/m/Y') : '...' }}
            </p>
        </div>

        <table id="pemeriksaan">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIK Balita</th>
                    <th>Nama Balita</th>
                    <th>Tanggal Lahir</th>
                    <th>Tanggal Pemeriksaan</th>
                    <th>Umur (Bulan)</th>
                    <th>Berat (Kg)</th>
                    <th>Tinggi (Cm)</th>
                    <th>Status Gizi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->balita->nik }}</td>
                        <td>{{ $item->balita->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->balita->tanggal_lahir)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                        <td>{{ $item->umur }}</td>
                        <td>{{ $item->berat }}</td>
                        <td>{{ $item->tinggi }}</td>
                        <td>{{ \App\Enums\StatusGizi::from($item->status_gizi)->getLabel() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
