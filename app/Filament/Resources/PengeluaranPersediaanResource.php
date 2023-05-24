<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengeluaranPersediaanResource\Pages;
use App\Filament\Resources\PengeluaranPersediaanResource\RelationManagers;
use App\Models\PengeluaranPersediaan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pegawai_id')
                    ->relationship('pegawai', 'name')
                    ->label('Nama Pegawai')
                    ->searchable()
                    ->required(),
                Select::make('barang_id')
                    ->relationship('barang', 'nama_barang')
                    ->label('Nama Barang')
                    ->searchable()
                    ->required(),
                Stepper::make('jumlah')
                    ->minValue(1),
                DatePicker::make('tgl_pengeluaran')
                    ->label('Tanggal Pengeluaran'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

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
