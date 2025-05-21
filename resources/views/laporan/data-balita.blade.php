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
                        <td>{{ $item->desa->nama }}</td>
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
