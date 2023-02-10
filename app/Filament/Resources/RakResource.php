<?php

namespace App\Filament\Resources;

use App\Models\Rak;
use App\Filament\Resources\RakResource\Pages;
use App\Filament\Resources\RakResource\RelationManagers;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Columns\TextColumn;

class RakResource extends Resource
{
    protected static ?string $model = Rak::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Arsip';

    protected static ?string $navigationLabel = 'Rak';

    protected static ?string $label = 'Rak';

    protected static ?string $pluralLabel = 'Rak';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_rak')->label('Kode Rak')->disableAutocomplete()->required(),
                TextInput::make('nama_rak')->label('Nama Rak')->disableAutocomplete()->required(),
                Grid::make()->schema([
                    MarkDownEditor::make('deskripsi')->required(),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_nama')->label('Nama Rak')->sortable()->searchable(),
                //Tables\Columns\TextColumn::make('deskripsi')->wrap(),
                TextColumn::make('created_at')->label('Dibuat Pada'),
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
            'index' => Pages\ListRaks::route('/'),
            'create' => Pages\CreateRak::route('/create'),
            'edit' => Pages\EditRak::route('/{record}/edit'),
            'view' => Pages\ViewRak::route('/{record}'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::$model::all()->count();
    }
}
