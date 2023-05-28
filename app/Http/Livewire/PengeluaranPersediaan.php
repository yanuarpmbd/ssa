<?php

namespace App\Http\Livewire;

use App\Models\PengeluaranPersediaan as ModelsPengeluaranPersediaan;
use App\Models\Persediaan;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Closure;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Icetalker\FilamentStepper\Forms\Components\Stepper;

class PengeluaranPersediaan extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $barang = [];

    public $data;

    public $persediaan_id, $stock, $jumlah, $satuan;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(1)
                    ->schema([
                        Select::make('pegawai_id')
                            ->relationship('pegawai', 'name')
                            ->label('Nama Pegawai')
                            ->required(),
                    ]),
                Grid::make(1)
                    ->schema([
                        Repeater::make('barang')
                            ->relationship()
                            ->schema([
                                Select::make('persediaan_id')
                                    ->options(Persediaan::query()->pluck('nama_barang', 'id'))
                                    ->label('Nama Barang')
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('stock', Persediaan::find($state)?->jumlah ?? 0) AND $set('satuan', Persediaan::find($state)?->satuan ?? 0))
                                    ->required(),
                                TextInput::make('stock')
                                    ->label('Sisa Barang')
                                    ->disabled()
                                    ->numeric(),
                                Stepper::make('jumlah')
                                    ->label('Jumlah Permintaan')
                                    ->minValue(1)
                                    ->reactive()
                                    ->afterStateUpdated(function (Closure $set, $state, $get) {
                                        $set('stock', Persediaan::find($get('persediaan_id'))?->jumlah - $state);
                                    })
                                    ->rule(fn ($get) => static function ($attribute, $value, $fail) use ($get) {
                                        $stockWarehouse = Persediaan::where('id', $get('persediaan_id'))->first();
                                        if ($stockWarehouse && $stockWarehouse->jumlah < $value) {
                                            $fail('Jumlah Permintaan Melebihi Sisa Barang');
                                        }
                                    })
                                    ->required(),
                                TextInput::make('satuan')
                                    ->label('Satuan')
                                    ->disabled()
                            ])
                            ->columns(4)
                            ->dehydrated()
                            ->required(),
                    ]),
                Grid::make(1)
                    ->schema([
                        DateTimePicker::make('tgl_pengeluaran')
                            ->label('Tanggal Pengeluaran')
                            ->default(now())
                            ->required(),
                    ]),
        ];
    }

    protected function getFormModel(): string
    {
        return ModelsPengeluaranPersediaan::class;
    }

    public function create()
    {
        $this->data = $this->form->getState();
        foreach($this->data['barang'] as $barangs){
            $stocks = Persediaan::where('id', $barangs['persediaan_id'])->first();
            $stock = $stocks->jumlah - $barangs['jumlah'];
            $stocks->update(['jumlah' => $stock]);
        }
        
        $barang_relasi = ModelsPengeluaranPersediaan::create($this->form->getState());

        $this->form->model($barang_relasi)->saveRelationships(); 

        Notification::make()
            ->title('Data berhasil tersimpan')
            ->success()
            ->seconds(3)
            ->send();

        return redirect()->to('/persediaan');
    }

    public function render(): View
    {
        return view('livewire.pengeluaran-persediaan');
    }
}
