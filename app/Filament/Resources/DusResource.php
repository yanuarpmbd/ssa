<?php

namespace App\Filament\Resources;

use App\Models\Dus;
use App\Filament\Resources\DusResource\Pages;
use App\Filament\Resources\DusResource\RelationManagers;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class DusResource extends Resource
{
    protected static ?string $model = Dus::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?string $navigationGroup = 'Arsip';

    protected static ?string $navigationLabel = 'Dus';

    protected static ?string $label = 'Dus';

    protected static ?string $pluralLabel = 'Dus';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_dus')
                    ->disabled()
                    ->unique()
                    ->required(),
                Select::make('rak_id')
                    ->relationship('rak', 'nama_rak')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_dus')
                    ->sortable()
                    ->searchable()
                    ->label('Kode Dus'),
                TextColumn::make('rak.nama_rak')
                    ->sortable()
                    ->searchable()
                    ->label('Nama Rak'),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada'),
            ])
            ->filters([
                SelectFilter::make('rak')
                    ->relationship('rak', 'nama_rak')
                    ->label('Nama Rak'),
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
            'index' => Pages\ListDuses::route('/'),
            'create' => Pages\CreateDus::route('/create'),
            'edit' => Pages\EditDus::route('/{record}/edit'),
            'view' => Pages\ViewDus::route('/{record}'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::$model::all()->count();
    }
}
