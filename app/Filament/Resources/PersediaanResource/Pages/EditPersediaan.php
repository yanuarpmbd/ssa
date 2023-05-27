<?php

namespace App\Filament\Resources\PersediaanResource\Pages;

use App\Filament\Resources\PersediaanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersediaan extends EditRecord
{
    protected static string $resource = PersediaanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
