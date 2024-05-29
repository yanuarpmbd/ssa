<?php

namespace App\Filament\Resources\AgendaKalanResource\Pages;

use App\Filament\Resources\AgendaKalanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgendaKalan extends EditRecord
{
    protected static string $resource = AgendaKalanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
