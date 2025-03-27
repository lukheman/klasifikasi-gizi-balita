<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    protected $table = 'balita';
    protected $guarded = [];

    public function orangTua() { 
        return $this->belongsTo(OrangTua::class, 'id_orang_tua');
    }

    public function laporanGizi() { 
        return $this->hasMany(LaporanGizi::class, 'id_balita');
    }

}
