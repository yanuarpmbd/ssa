<?php

namespace App\Filament\Resources\ArsipResource\Pages;

use App\Filament\Resources\ArsipResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArsip extends CreateRecord
{
    protected static string $resource = ArsipResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
