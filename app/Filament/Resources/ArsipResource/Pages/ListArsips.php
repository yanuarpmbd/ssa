<?php

namespace App\Filament\Resources\ArsipResource\Pages;

use App\Filament\Resources\ArsipResource;
use App\Models\Arsip;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Models\Dus;
use Illuminate\Support\Facades\App;


class ListArsips extends ListRecords
{
    protected static string $resource = ArsipResource::class;

    protected static string $view = 'filament.resources.arsip-resource.pages.list-arsip';

    protected function getTableFiltersFormColumns(): int
    {
        return 2;
    }

    protected function getTableQuery(): Builder
    {
        if (auth()->user()->hasRole('super_admin')) {
            return parent::getTableQuery();
        }
        return parent::getTableQuery()->where('unit_kerja_id', Auth::user()->unit_kerja_id);
    }

    public function generateND($records)
    {
        parent::mount($records);
        static::authorizeResourceAccess();
        $records = $this->getRecord($records);

        dd($records);
    }

    public function updateRetensi()
    {
        $records = Arsip::all();
        $current = Carbon::now()->format('Y');
        foreach ($records as $record) {
            $diff = (int)$current - (int)$record->tahun;
            if ($diff < (int)$record->jenisArsip->retensi_inaktif) {
                $record->status = 1;
            } elseif ($diff > (int)$record->jenisArsip->retensi_inaktif AND $diff < (int)$record->jenisArsip->retensi_musnah) {
                $record->status = 0;
            } else {
                $record->status = 2;
            }
            $record->update(['status' => $record->status]);
        }
        //dd($record);
        $this->notify('success', 'Update Retensi Berhasil');
    }

    public function generateQR()
    {
        $records = Dus::all()->where('rak_id', 1);
        foreach ($records as $record) {
            $time = Carbon::now();
            $data = $record;
            $arsips = $record->arsip()->where('dus_id', $record->id)->get();
            $content = view('dusqr', compact('data', 'arsips', 'time'))->render();
            $pdf = App::make('snappy.pdf.wrapper');
            $pdf->loadHTML($content)
                ->setPaper('a5')
                ->setOrientation('landscape')
                ->setOption('enable-local-file-access', true);
            $pdfs = $pdf->download();
            $pdf_path = '/Arsip/PDF/' . $record->id . '-' . $record->nama_dus . '.pdf';
            Storage::disk('public')->put($pdf_path, $pdfs);
            //return response()->download(storage_path('app/public/Arsip/PDF/' . $this->record->id . '-' . $this->record->nama_dus . '.pdf'));
        }
    }
}
