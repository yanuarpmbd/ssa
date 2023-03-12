<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LayananTI extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'layananTI';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Layanan TI';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */

    protected static ?int $sort = 4;

    protected static ?string $pollingInterval = null;

    protected function getFilters(): ?array
    {
        $years[] = Carbon::now()->year;

        return $years;
    }
    protected function getOptions(): array
    {
        $bulan = array(
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $now = Carbon::now()->year;
        foreach ($bulan as $key => $value) {
            $query = DB::select(DB::raw("SELECT count(*) AS jumlah
            FROM
                tickets
            WHERE
                MONTH(created_at) = $key AND YEAR(created_at) = $now"));
            foreach ($query as $q) {
                if ($key != null) {
                    $obj = new \stdClass();
                    $obj = $q->jumlah;
                    $data_layanan[] = $obj;
                    $month[] = $value;
                }
            }
        }
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 400,
                'toolbar' => [
                    'show' => false,
                ],
            ],
            'series' => [
                [
                    'name' => 'Jumlah Layanan TI',
                    'data' => $data_layanan,
                ],
            ],
            'xaxis' => [
                'categories' => $month,
                'min' => 0,
                'floating' => true,
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => ['#F59E0B'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 10,
                    'horizontal' => true,
                ],
            ],
            'grid' => [
                'show' => false,
            ],
            'dataLabels' => [
                'enabled' => false,
            ],
            'colors' => ['#facc15', '#38bdf8'],
            'fill' => [
                'type' => 'gradient',
                'gradient' => [
                    'shade' => 'dark',
                    'type' => 'horizontal',
                    'shadeIntensity' => 0.5,
                    'gradientToColors' => ['#f43f5e'],
                    'inverseColors' => false,
                    'opacityFrom' => 1,
                    'opacityTo' => 1,
                    'stops' => [0, 100],
                ],
            ],
        ];
    }
}
