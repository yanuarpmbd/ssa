<?php

namespace App\Filament\Resources\DusResource\Pages;

use App\Filament\Resources\DusResource;
use App\Models\Dus;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateDus extends CreateRecord
{
    protected static string $resource = DusResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function mount(): void
    {
        //$dus_last_id = Dus::latest()->first()->id;
        $dus_last_id = DB::table('duses')->latest('id')->first()->id;
        if (is_null($dus_last_id)) {
            $dus = 1;
        }
        $dus = $dus_last_id + 1;
        $nama_dus = $dus;

        $this->form->fill([
            'nama_dus' => $nama_dus,
        ]);
    }
}
