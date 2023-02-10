<?php

namespace App\Filament\Resources\JenisArsipResource\Pages;

use App\Filament\Resources\JenisArsipResource;
use Filament\Resources\Pages\EditRecord;

class EditJenisArsip extends EditRecord
{
    protected static string $resource = JenisArsipResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
