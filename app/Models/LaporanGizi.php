<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanGizi extends Model
{

    protected $table = 'laporan_gizi';
    protected $guarded = [];

    public function balita() { 
        return $this->belongsTo(Balita::class, 'id_balita');
    }

    public function detailLaporan() { 
        return $this->hasOne(DetailLaporan::class, 'id_detail_laporan');
    }
}
