<?php

namespace App\Filament\Ahligizi\Pages;

use App\Models\Balita;
use App\Models\LaporanGizi;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

use Filament\Actions\Action;

use App\Filament\Helpers\CekGiziHelper;
use App\Livewire\GrafikKMS;

use Carbon\Carbon;

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


    public function mount(): void {
        $this->form->fill();
    }

    public function form(Form $form): Form {
        return $form
            ->schema([
                Select::make('kode_balita')
                    ->label('Nama Balita')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->options(Balita::all()->mapWithKeys(fn($o) => [$o->kode_balita => "{$o->kode_balita} - {$o->nama_balita}"]))
                    ->reactive()
   ->afterStateUpdated(function ($state, callable $set) {
                $tanggalLahir = Balita::where('kode_balita', $state)->value('tanggal_lahir');

                if ($tanggalLahir) {
                    $umur = ceil(Carbon::parse($tanggalLahir)->diffInMonths(Carbon::now()));
                    $set('umur', $umur);
                } else {
                    $set('umur', null);
                }
            }),
                DatePicker::make('tanggal')
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
            GrafikKMS::make([
                'status' => $this->status,
                'umurBayi' => $this->umur,
                'berat' => $this->berat
            ])
        ] : [];

    }

    /* protected function getHeaderActions(): array */
    /* { */
    /*     return [ */
    /*         Action::make('Show Form') */
    /*             ->label('Buka Form') */
    /*             ->modalHeading('Masukkan Data') */
    /*             ->modalButton('Kirim') */
    /*             ->form([ */
    /*                 TextInput::make('name') */
    /*                     ->label('Nama') */
    /*                     ->required(), */
    /*                 TextInput::make('age') */
    /*                     ->label('Umur') */
    /*                     ->numeric() */
    /*                     ->required(), */
    /*             ]) */
    /*             ->action(fn (array $data) => $this->submit($data)), // Jalankan submit(), */
    /**/
    /*         Action::make('Show Message') */
    /*             ->label('Lihat Pesan') */
    /*             ->modal() */
    /*             ->modalHeading('Pesan Anda') */
    /*             ->modalSubmitActionLabel('Tutup') */
    /*             ->modalDescription(fn () => $this->message) */
    /*             ->extraAttributes(['x-show' => '$wire.get(\'message\')']) // Tampilkan otomatis */
    /*     ]; */
    /* } */

}
