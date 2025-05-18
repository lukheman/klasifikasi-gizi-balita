<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPemeriksaan extends Model
{

    protected $table = 'riwayat_pemeriksaan';
    protected $guarded = [];

    public function balita() {
        return $this->belongsTo(Balita::class, 'id_balita');
    }

}
