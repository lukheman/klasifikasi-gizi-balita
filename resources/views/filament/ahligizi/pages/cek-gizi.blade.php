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

    @if ($status === 'stunting')
    <p>Balita terindikasi mengalami <strong>stunting</strong>, yaitu kondisi gagal tumbuh akibat kekurangan gizi kronis dalam waktu lama. Biasanya ditandai dengan tinggi badan yang lebih pendek dari anak seusianya.</p>
    @elseif ($status === 'underweight')
    <p>Balita berada dalam kategori <strong>underweight</strong>, yaitu berat badan kurang dibandingkan dengan standar usianya. Ini bisa disebabkan oleh kekurangan gizi secara umum.</p>
    @elseif ($status === 'normal')
    <p>Status gizi <strong>normal</strong>, artinya berat dan tinggi badan balita sesuai dengan standar usianya. Menunjukkan pertumbuhan yang sehat dan cukup gizi.</p>
    @elseif ($status === 'wasting')
    <p>Balita terindikasi <strong>wasting</strong>, yaitu kondisi kekurangan gizi akut yang menyebabkan berat badan sangat rendah dibandingkan tinggi badannya. Ini bisa menandakan masalah gizi yang serius dan perlu penanganan segera.</p>
    @elseif ($status === 'overweight')
    <p>Balita berada dalam kondisi <strong>overweight</strong>, yaitu berat badan berlebih dibandingkan dengan tinggi dan usia. Ini bisa jadi indikasi kelebihan asupan kalori dan risiko obesitas di masa depan.</p>
    @else
    <p>Status gizi tidak diketahui.</p>
    @endif

    @endif


</x-filament-panels::page>
