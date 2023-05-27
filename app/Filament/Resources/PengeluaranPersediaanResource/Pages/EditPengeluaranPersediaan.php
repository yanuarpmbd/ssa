<?php

namespace App\Filament\Resources\PengeluaranPersediaanResource\Pages;

use App\Filament\Resources\PengeluaranPersediaanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengeluaranPersediaan extends EditRecord
{
    protected static string $resource = PengeluaranPersediaanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
