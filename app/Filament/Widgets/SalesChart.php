<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class SalesChart extends Widget
{
    protected static string $view = 'filament.widgets.sales-chart';

    protected function getData(): array
    {
        return [
            'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'], // Wajib ada
            'series' => [
                [
                    'name' => 'Penjualan 2023',
                    'data' => [30, 40, 35, 50, 49, 60],
                ],
            ],
        ];
    }

}
