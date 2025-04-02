<?php

namespace App\Filament\Helpers;

use App\Models\DataLatih;

class CekGiziHelper {

    private static $K = 3;

    public static function cekStatusGizi($umur, $berat, $tinggi) {

        $dataLatih = DataLatih::all();

        $jarakEuchlidean = [];

        foreach ( $dataLatih as $latih) {

            $jarak = self::hitungJarak($umur, $berat, $tinggi, $latih->umur, $latih->berat, $latih->tinggi);

            $jarakEuchlidean[] = [$jarak, $latih->status];

        }

        usort($jarakEuchlidean, function ($a, $b) {
            return $a[0] <=> $b[0];
        });

        $subset = array_slice($jarakEuchlidean, 0, self::$K);

        $status = self::statusTerbanyak($subset);

        return $status;

    }

    private static function statusTerbanyak(array $data) {
        $counts = [];

        foreach($data as $item) {
            $status = $item[1];

            if(!isset($counts[$status])) {
                $counts[$status] = 0;
            }

            $counts[$status]++;
        }

        // urutkan status dengan jumlah terbanyak
        arsort($counts);
        return array_key_first($counts);
    }


    // fungsi untuk menghitung jarak antara data uji dengan data latih
    // fungsi ini menghitung data uji dengan 1 data latih
    private static function hitungJarak($ujiUmur, $ujiBerat, $ujiTinggi, $latihUmur, $latihBerat, $latihTinggi) {

        // dump($latihUmur, $latihBerat, $latihTinggi);

        $umurKuadrat = ($latihUmur - $ujiUmur)**2;
        $beratKuadrat = ($latihBerat - $ujiBerat )**2;
        $tinggiKuadrat = ($latihTinggi - $ujiTinggi)**2;

        // dd($umurKuadrat, $beratKuadrat, $tinggiKuadrat);
        $jarak = sqrt($umurKuadrat + $beratKuadrat + $tinggiKuadrat);

        return $jarak;

    }

}
