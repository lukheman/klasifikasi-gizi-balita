
<x-filament-widgets::widget>
    <x-filament::section>
        <div id="chart-container" style="height: 400px;"></div>
    </x-filament::section>
</x-filament-widgets::widget>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        Highcharts.chart("chart-container", {
            chart: { type: 'line' },
            title: { text: 'Grafik Penjualan' },
            xAxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'] },
            series: [{ name: 'Penjualan 2023', data: [30, 40, 35, 50, 49, 60] }]
        });
    });
</script>
