<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use App\Models\RiwayatPemeriksaan;

class LaporanController extends Controller
{
    public function giziBalita($id_balita) {
        $laporan_gizi = RiwayatPemeriksaan::query()->where('id_balita', $id_balita)->get(); // semua laporan gizi

        $balita = Balita::query()->where('id', $id_balita)->first();

        return view('laporan.gizi-balita', [
            'balita' => $balita,
            'laporan_gizi' => $laporan_gizi
        ]);

    }

    public function dataBalita() {
        $balita = Balita::query()->with(['orangTua', 'desa'])->get();


        return view('laporan.data-balita', [
            'balita' => $balita
        ]);
    }
}
