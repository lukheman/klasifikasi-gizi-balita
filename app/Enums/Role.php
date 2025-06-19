<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Role: string implements HasLabel
{

    case Admin = 'Ahli Gizi';
    case Kader = 'Kader';
    case Pimpinan = 'Pimpinan';
    case OrangTua = 'Orang Tua';

    public function getLabel(): ?string {
        return $this->value;
    }

    public function getColor(): ?string {
        return match($this) {
            self::Admin => 'primary',
            self::Kader => 'danger',
            self::Pimpinan=> 'success',
            self::OrangTua=> 'warning',
            default => 'default'
        };
    }

    public static function values(): array {
        return array_map(fn($case) => $case->value, self::cases());
    }


}
