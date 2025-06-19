<?php

namespace App\Filament\Kader\Pages;

use App\Livewire\GrafikKMS\GrafikTinggiBadan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Actions\Action;
use App\Filament\Helpers\CekGiziHelper;
use App\Livewire\GrafikKMS\GrafikBeratBadan;
use App\Models\RiwayatPemeriksaan;
use Carbon\Carbon;
use Filament\Support\View\Components\Modal;

use App\Models\Balita;
use App\Models\User;

use App\Enums\Role;

class CekGizi extends Page
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    protected static string $view = 'filament.kader.pages.cek-gizi';

    protected static ?int $navigationSort = 10;

    protected static ?string $navigationGroup = 'Pemeriksaan Gizi';

    protected static ?string $navigationLabel = 'Cek Gizi Balita';

    public ?array $data = [];

    public ?string $status = null;

    public ?int $umur = null;
    public ?float $berat = null;
    public ?float $tinggi = null;

    public ?string $nik = null;
    public ?string $nama = null;


    public function mount(): void {
        $this->form->fill();
    }

    public function form(Form $form): Form {
        return $form
            ->schema([
                TextInput::make('nik_orang_tua')
                    ->label('NIK Orang Tua')
                    ->reactive()
                    ->required()
                    ->rules('exists:users,nik')
                    ->validationMessages([
                        'exists' => 'NIK tidak terdaftar'
                    ])
                    ->afterStateUpdated(function(Set $set, ?string $state) {
                        $orang_tua = User::query()
                            ->where('nik', $state)
                            ->where('role', Role::OrangTua)
                            ->first();

                        if($orang_tua) {
                            if($orang_tua->id_desa !== auth()->user()->id_desa) {

                                Notification::make()
                                    ->title('NIK orang tua tidak terdaftar di desa' . auth()->user()->desa->naam)
                                    ->warning()
                                    ->send();

                                $set('nama_orang_tua', null);
                                return;

                            }

                            $set('nama_orang_tua', $orang_tua ? $orang_tua->name : null);

                        } else {

                            $set('nama_orang_tua', null);
                        }
                    }),
                TextInput::make('nama_orang_tua')
                    ->label('Nama Orang Tua'),
                Hidden::make('id_balita'),
                TextInput::make('nik')
                    ->label('NIK Balita')
                    ->reactive()
                    ->afterStateUpdated(function(Set $set, ?string $state) {
                        $balita = Balita::where('nik', $state)->first();

                        if($balita) {
                            if($balita->id_desa !== auth()->user()->id_desa) {

                                Notification::make()
                                    ->title('NIK balita tidak terdaftar di desa' . auth()->user()->desa->naam)
                                    ->warning()
                                    ->send();

                                $set('nama', null);
                                return;

                            }

                            $set('nama', $balita ? $balita->nama : null);
                            $set('id_balita', $balita ? $balita->id : null);
                            $umur = Carbon::parse($balita->tanggal_lahir)->diffInMonths(now());
                            $set('umur', ceil($umur));
                        } else {
                            Notification::make()
                                ->title('NIK tidak terdaftar')
                                ->warning()
                                ->send();

                            $set('nama', null);
                            return;
                        }

                    })
                ,
                TextInput::make('nama')
                    ->label('Nama Balita'),
                TextInput::make('umur')
                    ->required()
                    ->label('Umur (Bulan)')
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
        $this->nama = $data['nama'];
        $this->nik = $data['nik'];

        // simpan ke laporan
        RiwayatPemeriksaan::create([
            'id_balita' => $data['id_balita'],
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
