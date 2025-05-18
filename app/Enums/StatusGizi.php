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

    public function getColor(): string {
        return match($this) {
            Self::Stunting => 'danger',
            Self::Underweight => 'zinc',
            Self::Normal => 'primary',
            Self::Wasting => 'warning',
            Self::Overweight => 'danger',
            default => 'default'
        };
    }

    public static function values(): array {
        return array_map(fn($case) => $case->value, self::cases());
    }


}

