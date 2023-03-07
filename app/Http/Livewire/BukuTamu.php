<?php

namespace App\Http\Livewire;

use App\Models\BukuTamu as ModelsBukuTamu;
use App\Models\User;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;

class BukuTamu extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $nama, $no_telp, $asal_instansi, $user_id, $keperluan, $file_upload;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('nama')
                ->disableautocomplete()
                ->required(),
            TextInput::make('no_telp')
                ->mask(fn (TextInput\Mask $mask) => $mask->pattern('0000-0000-0000-0')->numeric())
                ->disableautocomplete()
                ->required(),
            TextInput::make('asal_instansi')
                ->disableautocomplete()
                ->required(),
            Select::make('user_id')
                ->label('Nama yang dituju')
                ->options(User::where('status', '1')->pluck('name', 'id'))
                ->required(),
            Textarea::make('keperluan')
                ->disableautocomplete()
                ->required(),
            FileUpload::make('file_upload')
                ->disk('public')
                ->directory('BukuTamu/' . Carbon::now()->format('F Y'))
                ->label('File Upload'),
        ];
    }

    public function create()
    {
        ModelsBukuTamu::create($this->form->getState());

        Notification::make()
            ->title('Data berhasil tersimpan')
            ->success()
            ->seconds(3)
            ->send();

        return redirect()->to('/buku-tamu');
    }

    public function render(): View
    {
        return view('livewire.buku-tamu');
    }
}
