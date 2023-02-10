<?php

namespace App\Filament\Resources\DusResource\Pages;

use App\Filament\Resources\DusResource;
use Filament\Resources\Pages\ViewRecord;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Models\Dus;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ViewDus extends ViewRecord
{
    protected static string $resource = DusResource::class;

    protected static string $view = 'filament.resources.dus-resource.pages.view-dus';

    public $qr, $qr_path;

    public function generateQr()
    {
        $qr = QrCode::format('png')
            ->style('round')
            ->eyeColor(0, 230, 163, 0, 0, 119, 179)
            ->color(230, 163, 0)
            ->backgroundColor(255, 255, 255, 0)
            ->size(300)
            ->errorCorrection('L')
            ->generate(url()->previous());
        $qr_path = '/Arsip/QR/' . $this->record->id . '-' . $this->record->nama_dus . '.png';
        $dus = Dus::findOrFail($this->record->id);
        $dus->update(['qr_path' => $qr_path]);
        Storage::disk('public')->put($qr_path, $qr);
        $this->notify('success', 'Generate QR Code Berhasil');
        return back();
    }
    public function qr()
    {
        $time = Carbon::now();
        $data = $this->record;
        $arsips = $this->record->arsip()->where('dus_id', $this->record->id)->get();
        $content = view('dusqr', compact('data', 'arsips', 'time'))->render();
        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML($content)
            ->setPaper('a5')
            ->setOrientation('landscape')
            ->setOption('enable-local-file-access', true);
        $pdfs = $pdf->download();
        $pdf_path = '/Arsip/PDF/' . $this->record->id . '-' . $this->record->nama_dus . '.pdf';
        Storage::disk('public')->put($pdf_path, $pdfs);
        return response()->download(storage_path('app/public/Arsip/PDF/' . $this->record->id . '-' . $this->record->nama_dus . '.pdf'));
    }
}
