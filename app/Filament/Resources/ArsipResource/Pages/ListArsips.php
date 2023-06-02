<?php

namespace App\Filament\Resources\ArsipResource\Pages;

use App\Filament\Resources\ArsipResource;
use App\Models\Arsip;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListArsips extends ListRecords
{
    protected static string $resource = ArsipResource::class;

    protected static string $view = 'filament.resources.arsip-resource.pages.list-arsip';

    protected function getTableFiltersFormColumns(): int
    {
        return 2;
    }

    protected function getTableQuery(): Builder
    {
        if(auth()->user()->hasRole('super_admin')){
            return parent::getTableQuery();
        }
        return parent::getTableQuery()->where('unit_kerja_id', Auth::user()->unit_kerja_id);
    }

    public function updateRetensi()
    {
        $records = Arsip::all();
        $current = Carbon::now()->format('Y-m-d');
        foreach($records as $record){
            $record->tanggal_arsip = Carbon::parse($record->tanggal_arsip);
            $diff = $record->tanggal_arsip->diffInYears($current);
            if($diff < $record->jenisArsip->retensi){
                $record->status = 1;
            }
            else{
                $record->status = 0;
            }
            $record->update(['status' => $record->status]);
        }
        $this->notify('success', 'Update Retensi Berhasil');
    }
}