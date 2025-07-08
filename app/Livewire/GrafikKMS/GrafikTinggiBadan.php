<?php

namespace App\Livewire\GrafikKMS;

use App\Models\StandarBeratWho;
use Filament\Widgets\ChartWidget;

class GrafikTinggiBadan extends ChartWidget
{
    protected static ?string $heading = 'Tinggi Badan Menurut Umur';

    public ?int $umur = null;
    public ?float $tinggi = null;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {

        $datasets = StandarBeratWho::all();

        return [
            'labels' => $datasets->pluck('bulan')->map(fn ($value) => (float) $value)->toArray(),
            'datasets' => array_merge(
                [
                    [
                        'label' => 'Data Anak',
                        'data' => [['x' => $this->umur, 'y' => $this->tinggi]],
                        'backgroundColor' => 'black',
                        'borderColor' => 'black',
                        'type' => 'scatter',
                    ]
                ],
                $this->createStandardDeviationDatasets($datasets)
            )
        ];
    }
    /**
     * @return array<int,array<string,mixed>>
     * @param mixed $umur
     */
    private function createStandardDeviationDatasets($umur): array
    {
        $datasets = [];
        $labels = ['SD-3', 'SD-2', 'SD-1', 'SD 0', 'SD +1', 'SD +2', 'SD +3'];
        $colors = ['black', 'orange', 'black', 'green', 'orange', 'black', 'black'];
        $dataFields = ['SD3neg', 'SD2neg', 'SD1neg', 'SD0', 'SD1', 'SD2', 'SD3'];

        foreach ($labels as $index => $label) {
            $datasets[] = [
                'label' => $label,
                'data' => $umur->pluck($dataFields[$index])->toArray(),
                'borderColor' => $colors[$index],
                'backgroundColor' => 'transparent',
                'borderWidth' => 1,
                'pointRadius' => 0,
                'tension' => 0.4
            ];
        }

        return $datasets;
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array {
        return [
            // 'responsive' => true,
            'plugins' => [
                'legend' => ['display' => false],
                'title' => [
                    'display' => false,
                    'text' => 'Tinggi Badan Menurut Umur',
                    'font' => ['size' => 16]
                ],
            ],
            'scales' => [
                'x' => [ 'title' => [ 'display' => true, 'text' => 'Umur (Bulan)' ] ],
                'y' => [ 'title' => [ 'display' => true, 'text' => 'Tinggi Badan (Cm)' ] ]
            ]
        ];
    }
}
