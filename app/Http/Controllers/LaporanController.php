<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use App\Models\LaporanGizi;

class LaporanController extends Controller
{
    public function giziBalita($id_balita) {
        $laporan_gizi = LaporanGizi::where('id_balita', $id_balita)->get(); // semua laporan gizi

        $balita = Balita::where('id', $id_balita)->first();

        return view('laporan.gizi-balita', [
            'balita' => $balita,
            'laporan_gizi' => $laporan_gizi
        ]);

    }
}
