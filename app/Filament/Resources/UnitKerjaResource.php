<?php

namespace App\Filament\Resources;

use App\Models\UnitKerja;
use App\Filament\Resources\UnitKerjaResource\Pages;
use App\Filament\Resources\UnitKerjaResource\RelationManagers;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class UnitKerjaResource extends Resource
{
    protected static ?string $model = UnitKerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $navigationGroup = 'Arsip';

    protected static ?string $navigationLabel = 'Unit Kerja';

    protected static ?string $label = 'Unit Kerja';

    protected static ?string $pluralLabel = 'Unit Kerja';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_unit_kerja')
                    ->label('Nama Unit Kerja')
                    ->disableAutocomplete()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('nama_unit_kerja')
                    ->searchable()
                    ->label('Nama Unit Kerja'),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ArsipRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnitKerjas::route('/'),
            'create' => Pages\CreateUnitKerja::route('/create'),
            'edit' => Pages\EditUnitKerja::route('/{record}/edit'),
            'view' => Pages\ViewUnitKerja::route('/{record}'),
        ];
    }
}
