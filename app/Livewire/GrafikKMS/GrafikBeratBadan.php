<?php

namespace App\Livewire\GrafikKMS;

use Filament\Widgets\ChartWidget;
use App\Models\StandarBeratWho;
use App\Models\Balita;
use App\Models\RiwayatPemeriksaan;

class GrafikBeratBadan extends ChartWidget
{
    protected static ?string $heading = 'Berat Badan Menurut Umur';

    public ?string $status = null;
    public ?int $umur = null;
    public ?float $berat = null;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {

        $data = RiwayatPemeriksaan::where('id_balita', Balita::first())
            ->orderBy('umur', 'asc')
            ->get()
            ->map(fn ($item) => ['x' => (float) $item->umur, 'y' => (float) $item->berat])
            ->toArray();

        $datasets = StandarBeratWho::all();

        return [
            'labels' => $datasets->pluck('bulan')->map(fn ($value) => (float) $value)->toArray(),
            'datasets' => array_merge(
                [
                    [
                        'label' => 'Data Anak',
                        'data' => [['x' => $this->umur, 'y' => $this->berat]],
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
        $colors = ['black', 'red', 'black', 'green', 'orange', 'black', 'black'];
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
