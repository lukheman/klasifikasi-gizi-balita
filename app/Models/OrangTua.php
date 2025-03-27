<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orang_tua';
    protected $guarded = [];

    public function balita() { 
        return $this->hasMany(Balita::class, 'id_orang_tua');
    }
}
