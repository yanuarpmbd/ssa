<?php

namespace App\Filament\Resources\PengeluaranPersediaanResource\Pages;

use App\Filament\Resources\PengeluaranPersediaanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengeluaranPersediaans extends ListRecords
{
    protected static string $resource = PengeluaranPersediaanResource::class;

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'tgl_pengeluaran';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
