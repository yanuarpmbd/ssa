<?php

namespace App\Filament\Resources\BukuTamuResource\Pages;

use App\Filament\Resources\BukuTamuResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBukuTamus extends ListRecords
{
    protected static string $resource = BukuTamuResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
