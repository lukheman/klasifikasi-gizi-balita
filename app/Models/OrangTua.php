<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrangTua extends Authenticatable implements FilamentUser
{
    protected $table = 'orang_tua';
    protected $guarded = [];

    public function desa(): HasOne {
        return $this->hasOne(Desa::class, 'id', 'id_desa');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'orangtua'; // Hanya izinkan akses ke panel 'orangtua'
    }
}
