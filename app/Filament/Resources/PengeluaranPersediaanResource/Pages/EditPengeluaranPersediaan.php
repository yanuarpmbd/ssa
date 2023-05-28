<?php

namespace App\Filament\Resources\PengeluaranPersediaanResource\Pages;

use App\Filament\Resources\PengeluaranPersediaanResource;
use App\Models\Persediaan;
use Filament\Pages\Actions;
use Filament\Pages\Actions\DeleteAction;
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
            Actions\DeleteAction::make()
                ->after(function () {
                    //dd($this->data);
                    foreach($this->data['barang'] as $barangs){
                        $stocks = Persediaan::where('id', $barangs['persediaan_id'])->first();
                        $stock = $stocks->jumlah + $barangs['jumlah'];
                        //dd($stock);
                        $stocks->update(['jumlah' => $stock]);
                    }
                }),
        ];
    }
}
