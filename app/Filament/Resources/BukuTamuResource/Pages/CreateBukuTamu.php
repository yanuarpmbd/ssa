<?php

namespace App\Filament\Resources\BukuTamuResource\Pages;

use App\Filament\Resources\BukuTamuResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBukuTamu extends CreateRecord
{
    protected static string $resource = BukuTamuResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
