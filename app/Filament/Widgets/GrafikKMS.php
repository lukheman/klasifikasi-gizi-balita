<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\StandarBeratWho;

class GrafikKMS extends ChartWidget
{
    protected static ?string $heading = '';

    public ?string $status = null;

    public ?int $umurBayi = null;
    public ?float $berat = null;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $endUmur = $this->umurBayi <= 56 ? $this->umurBayi + 4 : 60;

        $umur = StandarBeratWho::whereBetween('id', [1, $endUmur])->get();

        return [
            'labels' => $umur->pluck('bulan')->map(fn ($value) => (float) $value)->toArray(),
            'datasets' => array_merge(
                [
                    [
                        'label' => 'Data Anak',
                        'data' => [['x' => $this->umurBayi, 'y' => $this->berat]],
                        'backgroundColor' => 'black',
                        'borderColor' => 'black',
                        'type' => 'scatter',
                    ]
                ],
                $this->createStandardDeviationDatasets($umur)
            )
        ];
    }

    private function createStandardDeviationDatasets($umur): array
    {
        $datasets = [];
        $labels = ['SD-3', 'SD-2', 'SD-1', 'SD 0', 'SD +1', 'SD +2', 'SD +3'];
        $colors = ['yellow', 'cyan', 'green', 'blue', 'green', 'cyan', 'yellow'];
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
                    'display' => true,
                    'text' => 'Berat Badan Menurut Umur',
                    'font' => ['size' => 16]
                ],
            ],
            'scales' => [
                'x' => [ 'title' => [ 'display' => true, 'text' => 'Umur (Bulan)' ] ],
                'y' => [ 'title' => [ 'display' => true, 'text' => 'Berat Badan (Kg)' ] ]
            ]
        ];
    }
}
