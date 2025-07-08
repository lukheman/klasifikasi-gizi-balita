<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Data Balita</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <style>
        hr {
            height: 2px;
            background-color: black;
            border: none;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .text-center {
            text-align: center;
        }

        #keterangan tr td:first-child {
            width: 150px;
        }

        #pesanan {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
            font-size: 14px;
        }

        #pesanan th,
        #pesanan td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
            vertical-align: middle;
        }

        #pesanan th {
            background-color: #f2f2f2;
            font-weight: 700;
            text-transform: uppercase;
            color: #333;
        }

        #pesanan td {
            color: #444;
        }

        #pesanan tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #pesanan tr:hover {
            background-color: #e0e0e0;
        }

        #pesanan td:first-child {
            text-align: center;
            width: 50px;
        }

        .row {
            display: flex;
        }

        .col {
            flex: 1;
            padding: 10px;
        }
    </style>

</head>

<body onload="window.print()">
    <div class="container">
        <h3 class="text-center">PUSKESMAS WUNDULAKO</h3>
        <hr>
        <h5 class="text-center"><u>Laporan Data Balita</u></h5>

        <table id="pesanan">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>NIK Orang Tua</th>
                    <th>Orang Tua</th>
                    <th>Asal Desa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($balita as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->orangTua->nik }}</td>
                        <td>{{ $item->orangTua->name }}</td>
                        <td>{{ $item->desa->nama ?? 'Tidak diketahui' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col">
            </div>
            <div class="col" style="text-align: center;">
            </div>
        </div>
    </div>
</body>

</html>
