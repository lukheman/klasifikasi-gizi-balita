<x-filament-panels::page>
    <div>
        <form wire:submit="create">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-6">
                Cek Gizi Balita
            </x-filament::button>
        </form>
    </div>

    @if (isset($status))
    <div style="text-align: center;">
        @if ($status === 'stunting')
        <p class="px-4 py-2 rounded-lg shadow-sm bg-green-100" style="background-color: #D4F4DD;">Balita dengan NIK {{ $nik }} dan nama {{ $nama }} terindikasi mengalami <strong>stunting</strong>.</p>
        @elseif ($status === 'underweight')
        <p class="px-4 py-2 rounded-lg shadow-sm bg-green-100" style="background-color: #D4F4DD;">Balita dengan NIK {{ $nik }} dan nama {{ $nama }} berada dalam kategori <strong>underweight</strong>.</p>
        @elseif ($status === 'normal')
        <p class="px-4 py-2 rounded-lg shadow-sm bg-green-100" style="background-color: #D4F4DD;">Balita dengan NIK {{ $nik }} dan nama {{ $nama }} memiliki status gizi <strong>normal</strong>.</p>
        @elseif ($status === 'wasting')
        <p class="px-4 py-2 rounded-lg shadow-sm bg-green-100" style="background-color: #D4F4DD;">Balita dengan NIK {{ $nik }} dan nama {{ $nama }} terindikasi <strong>wasting</strong>.</p>
        @elseif ($status === 'overweight')
        <p class="px-4 py-2 rounded-lg shadow-sm bg-green-100" style="background-color: #D4F4DD;">Balita dengan NIK {{ $nik }} dan nama {{ $nama }} berada dalam kondisi <strong>overweight</strong>.</p>
        @else
        <p class="px-4 py-2 rounded-lg shadow-sm bg-green-100" style="background-color: #D4F4DD;">Status gizi balita dengan NIK {{ $nik }} dan nama {{ $nama }} tidak diketahui.</p>
        @endif
    </div>
    @endif
</x-filament-panels::page>
