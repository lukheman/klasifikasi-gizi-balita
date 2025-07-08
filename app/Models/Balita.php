<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Balita extends Model
{
    protected $table = 'balita';
    protected $guarded = [];

    public function orangTua() {
        return $this->belongsTo(OrangTua::class, 'id_orang_tua');
    }

    public function riwayatPemeriksaan() {
        return $this->hasMany(RiwayatPemeriksaan::class, 'id_balita');
    }

    public function desa(): HasOne {
        return $this->hasOne(Desa::class, 'id', 'id_desa');
    }

}
