<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum StatusGizi: string implements HasLabel {
    case Stunting = 'Stunting';
    case Underweight = 'Underweight';
    case Normal = 'Normal';
    case Wasting = 'Wasting';
    case Overweight = 'Overweight';

    public function getLabel(): string {
        return $this->value;
    }

    public function getColor() {
        return match($this) {
            Self::Stunting => 'danger',
            Self::Underweight => 'danger',
            Self::Normal => 'primary',
            Self::Wasting => 'warning',
            Self::Overweight => 'danger',
            default => 'default'
        };
    }


    /**
     * Mengembalikan array asosiatif dari enum case value sebagai key dan value.
     *
     * Contoh output:
     * [
     *     'Stunting' => 'Stunting',
     *     'Underweight' => 'Underweight',
     * ]
     *
     * @return array
     */
    public static function labels(): array {
        return array_combine(
            array_map(fn($case) => $case->value, self::cases()),
            array_map(fn($case) => $case->value, self::cases())
        );
    }

    /**
     * Mengembalikan array dari semua nilai enum.
     *
     * Contoh output:
     * [
     *     'Stunting',
     *     'Underweight',
     * ]
     *
     * @return array
     */
    public static function values(): array {
        return array_map(fn($case) => $case->value, self::cases());
    }


}

