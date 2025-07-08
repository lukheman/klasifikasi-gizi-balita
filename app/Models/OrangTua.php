<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrangTua extends Model
{
    protected $table = 'orang_tua';
    protected $guarded = [];

    public function desa(): HasOne {
        return $this->hasOne(Desa::class, 'id', 'id_desa');
    }
}
