<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersediaanResource\Pages;
use App\Filament\Resources\PersediaanResource\RelationManagers;
use App\Models\Persediaan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersediaanResource extends Resource
{
    protected static ?string $model = Persediaan::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Persediaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_barang')
                    ->disableautocomplete()
                    ->required(),
                TextInput::make('nama_barang')
                    ->disableautocomplete()
                    ->required(),
                TextInput::make('jumlah')
                    ->disableautocomplete()
                    ->required(),
                TextInput::make('satuan')
                    ->disableautocomplete()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_barang')->label('Kode Barang')->sortable()->searchable(),
                TextColumn::make('nama_barang')->label('Nama Barang')->sortable()->searchable(),
                TextColumn::make('jumlah')->label('Jumlah'),
                TextColumn::make('satuan')->label('Satuan'),
                TextColumn::make('created_at')->label('Dibuat Pada'),
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
            'index' => Pages\ListPersediaans::route('/'),
            'create' => Pages\CreatePersediaan::route('/create'),
            'edit' => Pages\EditPersediaan::route('/{record}/edit'),
        ];
    }    
}
