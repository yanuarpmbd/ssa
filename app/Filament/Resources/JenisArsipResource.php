<?php

namespace App\Filament\Resources;

use App\Models\JenisArsip;
use App\Filament\Resources\JenisArsipResource\Pages;
use App\Filament\Resources\UnitKerjaResource\RelationManagers;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Columns\TextColumn;

class JenisArsipResource extends Resource
{
    protected static ?string $model = JenisArsip::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Arsip';

    protected static ?string $navigationLabel = 'Klasifikasi Arsip';

    protected static ?string $label = 'Klasifikasi Arsip';

    protected static ?string $pluralLabel = 'Klasifikasi Arsip';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_arsip')
                    ->disableAutocomplete()
                    ->required(),
                TextInput::make('jenis_arsip')
                    ->disableAutocomplete()
                    ->required(),
                TextInput::make('retensi')
                    ->disableAutocomplete()
                    ->numeric()
                    ->label('Retensi (*Tahun)')
                    ->required(),
                Grid::make()->schema([
                    MarkDownEditor::make('deskripsi')->required(),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kode_jenis')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                TextColumn::make('retensi')
                    ->label('Retensi (*Tahun)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('deskripsi')
                    ->sortable()
                    ->wrap(),
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
            'index' => Pages\ListJenisArsips::route('/'),
            'create' => Pages\CreateJenisArsip::route('/create'),
            'edit' => Pages\EditJenisArsip::route('/{record}/edit'),
            'view' => Pages\ViewJenisArsip::route('/{record}'),
        ];
    }
}
