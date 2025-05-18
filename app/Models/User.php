<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

use App\Enums\Role;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'role',
        'id_desa',
        'nik',
        'alamat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool {

        return match ($panel->getId()) {
            'admin' => Role::from($this->role) === Role::Admin,
            'ahligizi' => Role::from($this->role) === Role::AhliGizi,
            'orangtua' => Role::from($this->role) === Role::OrangTua,
            'pimpinan' => Role::from($this->role) === Role::Pimpinan,
            default => false,
        };

    }

    public function balita() {
        return $this->hasMany(Balita::class, 'id_user');
    }

    public function desa(): HasOne {
        return $this->hasOne(Desa::class, 'id', 'id_desa');
    }

}
