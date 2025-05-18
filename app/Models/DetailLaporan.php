<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailLaporan extends Model
{
    protected $table = 'detail_laporan';
    protected $guarded = [];

    public function laporanGizi() {
        return $this->hasOne(RiwayatPemeriksaan::class, 'id_detail_laporan');
    }
}
