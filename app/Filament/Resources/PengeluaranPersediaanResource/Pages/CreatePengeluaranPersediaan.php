<?php

namespace App\Filament\Resources\PengeluaranPersediaanResource\Pages;

use App\Filament\Resources\PengeluaranPersediaanResource;
use App\Models\Persediaan;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePengeluaranPersediaan extends CreateRecord
{
    protected static string $resource = PengeluaranPersediaanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function beforeCreate(): void
    {
        foreach($this->data['barang'] as $barangs){
            $stocks = Persediaan::where('id', $barangs['persediaan_id'])->first();
            $stock = $stocks->jumlah - $barangs['jumlah'];
            $stocks->update(['jumlah' => $stock]);
        }
    }
}
