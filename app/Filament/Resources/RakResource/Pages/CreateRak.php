<?php

namespace App\Filament\Resources\RakResource\Pages;

use App\Filament\Resources\RakResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRak extends CreateRecord
{
    protected static string $resource = RakResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
