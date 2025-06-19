<?php

namespace App\Livewire\GrafikKMS;

use App\Models\RiwayatPemeriksaan;
use Filament\Widgets\ChartWidget;
use App\Models\StandarBeratWho;
use App\Models\Balita;

class GrafikRiwayatBeratBadan extends ChartWidget
{
    protected static ?string $heading = 'Grafik Berat Badan Balita';

    public ?int $id_balita = null;
    protected ?Balita $balita = null;

    public function mount(): void
    {
        if ($this->id_balita) {
            $this->balita = Balita::find($this->id_balita);
        }
    }

    protected function getData(): array
    {
        if (!$this->balita) {
            return [
                'labels' => [],
                'datasets' => [],
            ];
        }

        $datasets = StandarBeratWho::all();
        $data = RiwayatPemeriksaan::where('id_balita', $this->balita->id)
            ->orderBy('umur', 'asc')
            ->get()
            ->map(fn ($item) => ['x' => (float) $item->umur, 'y' => (float) $item->berat])
            ->toArray();

        dd($data);

        return [
            'labels' => $datasets->pluck('bulan')->map(fn ($value) => (float) $value)->toArray(),
            'datasets' => array_merge(
                [
                    [
                        'label' => 'Data Anak',
                        'data' => $data,
                        'backgroundColor' => 'black',
                        'borderColor' => 'black',
                    ]
                ],
                $this->createStandardDeviationDatasets($datasets)
            )
        ];
    }

    private function createStandardDeviationDatasets($umur): array
    {
        $datasets = [];
        $labels = ['SD-3', 'SD-2', 'SD-1', 'SD 0', 'SD +1', 'SD +2', 'SD +3'];
        $colors = ['yellow', 'cyan', 'blue', 'green', 'blue', 'cyan', 'yellow'];
        $dataFields = ['SD3neg', 'SD2neg', 'SD1neg', 'SD0', 'SD1', 'SD2', 'SD3'];

        foreach ($labels as $index => $label) {
            $datasets[] = [
                'label' => $label,
                'data' => $umur->pluck($dataFields[$index])->map(fn ($value) => (float) $value)->toArray(),
                'borderColor' => $colors[$index],
                'backgroundColor' => 'transparent',
                'borderWidth' => 1,
                'pointRadius' => 0,
                'tension' => 0.4
            ];
        }

        return $datasets;
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => ['display' => true], // Enable legend for clarity
                'title' => [
                    'display' => true,
                    'text' => 'Berat Badan Menurut Umur',
                    'font' => ['size' => 16]
                ],
            ],
            'scales' => [
                'x' => ['title' => ['display' => true, 'text' => 'Umur (Bulan)']],
                'y' => ['title' => ['display' => true, 'text' => 'Berat Badan (Kg)']]
            ]
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
