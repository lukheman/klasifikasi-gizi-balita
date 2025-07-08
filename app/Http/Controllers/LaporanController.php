<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use App\Models\RiwayatPemeriksaan;
use App\Enums\Role;

class LaporanController extends Controller
{
    public function giziBalita($id_balita) {
        // urutkan berdsarkan umur
        $laporan_gizi = RiwayatPemeriksaan::where('id_balita', $id_balita)
            ->orderBy('umur', 'asc')
            ->get();

        $balita = Balita::query()->where('id', $id_balita)->first();

        return view('laporan.gizi-balita', [
            'balita' => $balita,
            'laporan_gizi' => $laporan_gizi
        ]);

    }

    public function dataBalita() {

        if (Role::from(auth()->user()->role) === Role::Kader) {

            $balita = Balita::query()->with(['orangTua', 'desa'])->where('id_desa', auth()->user()->id_desa)->get();

        } else {
            $balita = Balita::query()->with(['orangTua', 'desa'])->get();
        }


        return view('laporan.data-balita', [
            'balita' => $balita
        ]);
    }

    public function riwayatPemeriksaan(Request $request) {

$query = RiwayatPemeriksaan::query()
        ->with('balita') // Load relasi balita
        ->when($request->status_gizi, fn ($q) => $q->whereIn('status_gizi', (array) $request->status_gizi))
        ->when($request->dari, fn ($q) => $q->where('created_at', '>=', $request->dari))
        ->when($request->sampai, fn ($q) => $q->where('created_at', '<=', $request->sampai));
        $data = $query->get();
        return view('laporan.riwayat-pemeriksaan', [
            'data' => $data,
            'status_gizi' => $request->status_gizi,
            'dari' => $request->dari,
            'sampai' => $request->sampai
        ]);
    }

}
