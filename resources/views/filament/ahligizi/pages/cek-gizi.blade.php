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

        <p>{{ $status }}</p>
        
    @endif


</x-filament-panels::page>
