<?php

namespace App\Filament\Resources\RakResource\Pages;

use App\Filament\Resources\RakResource;
use Filament\Resources\Pages\ViewRecord;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Models\Rak;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class ViewRak extends ViewRecord
{
    protected static string $resource = RakResource::class;

    protected static string $view = 'filament.resources.rak-resource.pages.view-rak';

    public $qr, $qr_path;

    public function generateQr()
    {
        $qr = QrCode::format('png')
            ->style('round')
            ->eyeColor(0, 230, 163, 0, 0, 119, 179)
            ->color(230, 163, 0)
            ->backgroundColor(255, 255, 255, 0)
            ->size(1000)
            ->errorCorrection('L')
            ->generate(url()->previous());
        $qr_path = '/Arsip/QR/' . $this->record->id . $this->record->nama_rak . '.png';
        $dus = Rak::findOrFail($this->record->id);
        $dus->update(['qr_path' => $qr_path]);
        Storage::disk('public')->put($qr_path, $qr);
        $this->notify('success', 'Generate QR Code Berhasil');
        return back();
    }

    // public function downloadQr()
    // {
    //     return response()->download(storage_path('app/public/'. $this->record->qr_path));     
    // }

    public function qr()
    {
        $time = Carbon::now();
        $data = $this->record;
        $arsips = $this->record->arsip()->where('rak_id', $this->record->id)->get();
        $content = view('rakqr', compact('data', 'arsips', 'time'))->render();
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML($content)
            ->setPaper('a6')
            ->setOption('enable-local-file-access', true);
        $pdfs = $pdf->download()->getOriginalContent();
        $pdf_path = '/Arsip/PDF/' . $this->record->id . '-' . $this->record->nama_rak . '.pdf';
        Storage::disk('public')->put($pdf_path, $pdfs);
        return response()->download(storage_path('app/public/Arsip/PDF/' . $this->record->id . '-' . $this->record->nama_rak . '.pdf'));
    }
}
