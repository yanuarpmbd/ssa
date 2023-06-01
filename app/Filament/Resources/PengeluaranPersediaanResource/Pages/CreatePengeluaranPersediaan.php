<?php

namespace App\Filament\Resources\PengeluaranPersediaanResource\Pages;

use App\Filament\Resources\PengeluaranPersediaanResource;
use App\Models\Persediaan;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class CreatePengeluaranPersediaan extends CreateRecord
{
    protected static string $resource = PengeluaranPersediaanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function beforeCreate(): void
    {
        //dd($this->data['barang']->nama_barang);
        foreach($this->data['barang'] as $barangs){
            $stocks = Persediaan::where('id', $barangs['persediaan_id'])->first();
            $stock = $stocks->jumlah - $barangs['jumlah'];
            $stocks->update(['jumlah' => $stock]);
        }
        dd($stocks->nama_barang);
    }

    protected function afterCreate(): void
    {
        $records = $this->record;
        //$nama_pegawai = $records->pegawai->name;
        foreach($records['barang'] as $barangs){
            $barang = Persediaan::where('id', $barangs['persediaan_id'])->first();
            //$kode_barang = $barang->kode_barang;
            //$nama_barang = $barang->nama_barang;
            //$jumlah = $barang->jumlah;
            //$satuan = $barang->satuan;
        }
        //dd($barang);

        $content = view('persediaan', compact('records', 'barang'))->render();
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML($content)
            ->setPaper('a4')
            ->setOption('enable-local-file-access', true);
        $pdfs = $pdf->inline()->getOriginalContent();

        $pdf_path = '/Persediaan/PDF/' . $records->id. '-' . $records->pegawai->name . '.pdf';
        //dd($pdf_path);
        Storage::disk('public')->put($pdf_path, $pdfs);

        response()->download(storage_path('app/public/Persediaan/PDF/' . $records->id. '-' . $records->pegawai->name . '.pdf'));
    }
}
