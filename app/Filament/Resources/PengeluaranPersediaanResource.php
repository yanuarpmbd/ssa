<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengeluaranPersediaanResource\Pages;
use App\Filament\Resources\PengeluaranPersediaanResource\RelationManagers;
use App\Models\PengeluaranPersediaan;
use App\Models\PengeluaranPersediaanItem;
use App\Models\Persediaan;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Icetalker\FilamentStepper\Forms\Components\Stepper;

class PengeluaranPersediaanResource extends Resource
{
    protected static ?string $model = PengeluaranPersediaan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-add';

    protected static ?string $navigationGroup = 'Persediaan';

    protected static function getNavigationBadge(): ?string
    {
        return static::$model::get()->count();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('stock', Persediaan::find($state)?->jumlah ?? 0))
                                    ->required(),
                                TextInput::make('stock')
                                    ->label('Sisa Barang')
                                    ->disabled()
                                    ->rules(['integer', 'min:0'])
                                    ->numeric(),
                                Stepper::make('jumlah')
                                    ->label('Jumlah Permintaan')
                                    ->minValue(1)
                                    ->reactive()
                                    ->afterStateUpdated(function (Closure $set, $state, $get) {
                                        $set('stock', Persediaan::find($get('persediaan_id'))?->jumlah - $state);
                                    })
                                    ->rule(fn ($get) => static function ($attribute, $value, $fail) use ($get) {
                                        $stockWarehouse = Persediaan::where('persediaan_id', $get('persediaan_id'))->first();
                                        dd($stockWarehouse);
                                        if ($stockWarehouse && $stockWarehouse->jumlah < $value) {
                                            $fail('Insufficient stock');
                                        }
                                    })
                                    ->required(),
                            ])
                            ->columns(3)
                            ->required(),
                    ]),
                Grid::make(1)
                    ->schema([
                        DatePicker::make('tgl_pengeluaran')
                            ->label('Tanggal Pengeluaran')
                            ->default(today())
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pegawai.name'),
                TextColumn::make('tgl_pengeluaran')
                    ->label('Tanggal Pengeluaran')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal dibuat')
                    ->date()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengeluaranPersediaans::route('/'),
            'create' => Pages\CreatePengeluaranPersediaan::route('/create'),
            'edit' => Pages\EditPengeluaranPersediaan::route('/{record}/edit'),
        ];
    }
}
