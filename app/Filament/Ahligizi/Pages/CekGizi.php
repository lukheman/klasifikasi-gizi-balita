<?php

namespace App\Filament\Ahligizi\Pages;

use App\Livewire\GrafikKMS\GrafikTinggiBadan;
use App\Models\Balita;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

use Filament\Actions\Action;

use App\Filament\Helpers\CekGiziHelper;
use App\Livewire\GrafikKMS\GrafikBeratBadan;

use App\Models\LaporanGizi;

use Carbon\Carbon;
use Filament\Support\View\Components\Modal;

class CekGizi extends Page
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static string $view = 'filament.ahligizi.pages.cek-gizi';

    protected static ?int $navigationSort = 10;

    public ?array $data = [];

    public ?string $status = null;

    public ?int $umur = null;
    public ?float $berat = null;
    public ?float $tinggi = null;


    public function mount(): void {
        $this->form->fill();
    }

    public function form(Form $form): Form {
        return $form
            ->schema([
                Select::make('id_balita')
                    ->label('Nama Balita')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->options(Balita::all()->mapWithKeys(fn($o) => [$o->id => "{$o->kode_balita} - {$o->nama_balita}"]))
                    ->reactive()
   ->afterStateUpdated(function ($state, callable $set) {
                $tanggalLahir = Balita::where('id', $state)->value('tanggal_lahir');

                if ($tanggalLahir) {
                    $umur = ceil(Carbon::parse($tanggalLahir)->diffInMonths(Carbon::now()));
                    $set('umur', $umur);
                } else {
                    $set('umur', null);
                }
            }),
                DatePicker::make('tanggal_pemeriksaan')
                    ->required()
                    ->label('Tanggal Pemeriksaan')
                    ->default(now())
                    ->maxDate(now()),
                TextInput::make('umur')
                    ->required()
                    ->label('Umur (Bulan)')
                    ->readonly()
                    ->integer(),
                TextInput::make('berat')
                    ->required()
                    ->label('Berat (Kg)')
                    ->numeric(),
                TextInput::make('tinggi')
                    ->required()
                    ->label('Tinggi (cm)')
                    ->numeric()
            ])
            ->statePath('data');
    }

    public function create(): void {
        $data = $this->form->getState();

        $this->status = CekGiziHelper::cekStatusGizi($data['umur'], $data['berat'], $data['tinggi']);
        $this->umur = $data['umur'];
        $this->berat = $data['berat'];
        $this->tinggi = $data['tinggi'];

        // simpan ke laporan
        LaporanGizi::create([
            'id_balita' => $data['id_balita'],
            'tanggal_pemeriksaan' => $data['tanggal_pemeriksaan'],
            'umur' => $data['umur'],
            'berat' => $data['berat'],
            'tinggi' => $data['tinggi'],
            'status_gizi' => $this->status
        ]);


        Notification::make()
            ->title('Menyimpan laporan gizi balita')
            ->success()
            ->seconds(5)
            ->send();

        // Memicu render ulang agar widget muncul
        $this->dispatch('refresh');

    }

    protected  function getFooterWidgets(): array {

        return $this->status !== null ? [
            GrafikBeratBadan::make([
                'status' => $this->status,
                'umur' => $this->umur,
                'berat' => $this->berat
            ]),
            GrafikTinggiBadan::make([
                'umur' => $this->umur,
                'tinggi' => $this->tinggi
            ])
        ] : [];

    }


}
