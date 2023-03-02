<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuTamuResource\Pages;
use App\Filament\Resources\BukuTamuResource\RelationManagers;
use App\Models\BukuTamu;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class BukuTamuResource extends Resource
{
    protected static ?string $model = BukuTamu::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Buku Tamu';

    protected static ?string $navigationLabel = 'Buku Tamu';

    protected static ?string $label = 'Buku Tamu';

    protected static ?string $pluralLabel = 'Buku Tamu';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 TextInput::make('nama')
                ->required(),
            TextInput::make('no_telp')
                ->required(),
            TextInput::make('asal_instansi')
                ->required(),
            Select::make('user_id')
                ->label('Nama yang dituju')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),
            MarkdownEditor::make('keperluan')
                ->required(),
            FileUpload::make('file_upload')
                ->acceptedFileTypes(['application/pdf'])
                ->disk('public')
                ->directory('BukuTamu/' . Carbon::now()->format('F Y'))
                ->preserveFilenames()
                ->label('File Upload'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('no_telp'),
                TextColumn::make('asal_instansi'),
                TextColumn::make('user.name')
                    ->sortable()
                    ->wrap()
                    ->label('Nama yg dituju'),
                TextColumn::make('created_at')->label('Waktu  Kunjungan'),
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
            'index' => Pages\ListBukuTamus::route('/'),
            'create' => Pages\CreateBukuTamu::route('/create'),
            'edit' => Pages\EditBukuTamu::route('/{record}/edit'),
        ];
    }
}
