<?php

namespace App\Filament\Resources\ArsipResource\Pages;

use App\Filament\Resources\ArsipResource;
use Filament\Resources\Pages\ViewRecord;

class ViewArsip extends ViewRecord
{
    protected static string $resource = ArsipResource::class;

    protected static string $view = 'filament.resources.arsip-resource.pages.view-arsip';

    public function mount($record): void
    {
        parent::mount($record);
        
        static::authorizeResourceAccess();

        $this->record = $this->getRecord($record);

        if($this->record->status){
            $this->record->status_arsip = 'Aktif';
        }
        else{
            $this->record->status_arsip = 'Inaktif';
        }
        $this->getRecord($record)->incrementCounter('number_of_arsip_views');
    }

    public function download()
    {
        return response()->download(storage_path('app/public/'. $this->record->upload_arsip));     
    }
}