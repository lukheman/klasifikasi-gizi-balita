<?php

namespace App\Filament\Pages;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;

use Filament\Forms\Components\TextInput;

use App\Livewire\GrafikKMS\GrafikBeratBadan;
use App\Livewire\GrafikKMS\GrafikTinggiBadan;
use App\Models\RiwayatPemeriksaan;
use Filament\Forms\Components\Grid;

class ViewGrafikKms extends Page implements HasForms
{

    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.view-grafik-kms';

    // Define the route slug
    protected static ?string $slug = 'riwayat-pemeriksaan/grafik-kms/{record}';

    protected static bool $shouldRegisterNavigation = false;


    public static ?string $title = 'Grafik KMS';

    public $record;
    public ?array $data;

    public function mount($record): void {

        // Resolve record as ID or model instance
        $this->record = $record instanceof RiwayatPemeriksaan
            ? $record->load('balita')
            : RiwayatPemeriksaan::with('balita')->findOrFail($record);

        /* dd($this->record); */
        /* dd($this->record->status); */
        $this->form->fill([
            'status_gizi' => $this->record->status_gizi,
            'umur' => $this->record->balita->umur ?? $this->record->umur,
            'berat' => $this->record->berat,
            'tinggi' => $this->record->tinggi,
        ]);


    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
    Grid::make(2) // 2 columns
                ->schema([
                    TextInput::make('status_gizi')
                        ->label('Status')
                        ->readOnly()
                        ->required(),
                    TextInput::make('umur')
                        ->label('Umur (Bulan)')
                        ->readOnly()
                        ->numeric()
                        ->required(),
                ]),
            Grid::make(2) // 2 columns
                ->schema([
                    TextInput::make('berat')
                        ->label('Berat (kg)')
                        ->readOnly()
                        ->numeric()
                        ->required(),
                    TextInput::make('tinggi')
                        ->label('Tinggi (cm)')
                        ->readOnly()
                        ->numeric()
                        ->required(),
                ]),
            ])
            ->statePath('data') ;


    }

    protected function getViewData(): array
    {
        return [
            'record' => $this->record,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            GrafikBeratBadan::make([
                'status' => $this->record->status_gizi,
                 'umur' => $this->record->umur,
                'berat' => $this->record->berat,
            ]),
            GrafikTinggiBadan::make([
                'umur' => $this->record->umur,
                'tinggi' => $this->record->tinggi,
            ])
        ];
    }

}
