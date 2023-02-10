<?php

namespace App\Filament\Widgets;

use App\Models\Arsip;
use App\Models\Dus;
use App\Models\Rak;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $bulan = array(
            '1'=>'Januari',
            '2'=>'Februari',
            '3'=>'Maret',
            '4'=>'April',
            '5'=>'Mei',
            '6'=>'Juni',
            '7'=>'Juli',
            '8'=>'Agustus',
            '9'=>'September',
            '10'=>'Oktober',
            '11'=>'November',
            '12'=>'Desember',
        );
        $now = Carbon::now()->year;
        foreach ($bulan as $key => $value){
            $query = DB::select(DB::raw("SELECT count(*) AS jumlah
            FROM
                arsips
            WHERE
                MONTH(created_at) = $key AND YEAR(created_at) = $now"));
            foreach ($query as $q){
                if ($key != null){
                    $obj = new \stdClass();
                    $obj = $q->jumlah;
                    $data_arsip[] = $obj;
                }
            }
        }
        foreach ($bulan as $key => $value){
            $query = DB::select(DB::raw("SELECT count(*) AS jumlah
            FROM
                duses
            WHERE
                MONTH(created_at) = $key AND YEAR(created_at) = $now"));
            foreach ($query as $q){
                if ($key != null){
                    $obj = new \stdClass();
                    $obj = $q->jumlah;
                    $data_dus[] = $obj;
                }
            }
        }
        foreach ($bulan as $key => $value){
            $query = DB::select(DB::raw("SELECT count(*) AS jumlah
            FROM
                raks
            WHERE
                MONTH(created_at) = $key AND YEAR(created_at) = $now"));
            foreach ($query as $q){
                if ($key != null){
                    $obj = new \stdClass();
                    $obj = $q->jumlah;
                    $data_rak[] = $obj;
                }
            }
        }
        //dd($data);
        return [
            Card::make('Dokumen Arsip', count(Arsip::all()))
                ->description('Total Dokumen')
                ->descriptionIcon('heroicon-o-archive')
                ->chart($data_arsip)
                ->color('success'),
            Card::make('Dus Arsip', count(Dus::all()))
                ->description('Total Dus')
                ->descriptionIcon('heroicon-o-inbox')
                ->chart($data_dus)
                ->color('warning'),
            Card::make('Rak Arsip', count(Rak::all()))
                ->description('Total Rak')
                ->descriptionIcon('heroicon-o-collection')
                ->chart($data_rak)
                ->color('danger'),
            ];
    }
}
