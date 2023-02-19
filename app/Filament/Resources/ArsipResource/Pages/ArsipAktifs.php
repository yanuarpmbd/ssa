<?php

namespace App\Filament\Resources\ArsipResource\Pages;

use App\Filament\Resources\ArsipResource;
use Filament\Resources\Pages\Page;
use App\Models\Arsip;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Carbon;

class ArsipAktifs extends ListRecords
{
    protected static string $resource = ArsipResource::class;

    protected static string $view = 'filament.resources.arsip-resource.pages.arsip-aktifs';

    protected function getTableFiltersFormColumns(): int
    {
        return 2;
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
