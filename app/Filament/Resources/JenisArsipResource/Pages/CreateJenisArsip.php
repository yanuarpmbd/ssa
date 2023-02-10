<?php

namespace App\Filament\Resources\JenisArsipResource\Pages;

use App\Filament\Resources\JenisArsipResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class CreateJenisArsip extends CreateRecord
{
    protected static string $resource = JenisArsipResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    
}
