<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Mail\LayananTIRegister;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Sgcomptech\FilamentTicketing\Events\NewTicket;
use Illuminate\Support\Facades\Mail;

class CreateTicket extends CreateRecord
{
    public $rec;

    public $recid;

    protected $queryString = ['rec', 'recid'];

    protected static bool $canCreateAnother = false;

    public static function getResource(): string
    {
        return config('filament-ticketing.ticket-resource');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($this->rec && $this->recid) {
            $data['ticketable_type'] = $this->rec;
            $data['ticketable_id'] = $this->recid;
        }

        $data['user_id'] = auth()->id();
        $data['identifier'] = strtoupper(Str::random(8));
        $data['status'] = 1; // first state
        $data['assigned_to_id'] = 1;

        return $data;
    }

    protected function getSubheading(): ?string
    {
        if ($this->rec) {
            $recInstance = $this->rec::findOrFail($this->recid);

            return $recInstance->{$recInstance->model_name()};
        } else {
            return null;
        }
    }

    protected function afterCreate(): void
    {
        NewTicket::dispatch($this->record);
        //dd($this->record->user->unitKerja->nama_unit_kerja);
        Mail::to($this->record->user->email)->send(new LayananTIRegister($this->record));
        Mail::to($this->record->assigned_to->email)->send(new LayananTIRegister($this->record));
        //Mail::to('yanuarpambudi.qualita@gmail.com')->send(new LayananTI($this->record));
    }

    protected function getTitle(): string
    {
        return __('Create Ticket');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
