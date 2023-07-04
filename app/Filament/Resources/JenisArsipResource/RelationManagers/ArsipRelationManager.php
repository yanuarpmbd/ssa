<?php

namespace App\Filament\Resources\JenisArsipResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class ArsipRelationManager extends RelationManager
{
    protected static string $relationship = 'arsip';

    protected static ?string $recordTitleAttribute = 'kode_arsip';

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
                TextColumn::make('unitKerja.nama_unit_kerja')
                    ->sortable()
                    ->label('Unit Kerja')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama_arsip')
                    ->sortable()
                    ->label('Nama Dokumen')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('jenisArsip.kode_jenis')
                    ->sortable()
                    ->wrap()
                    ->label('Kode Klasifikasi'),
                TextColumn::make('dus.nama_dus')
                    ->sortable()
                    ->label('Kode Dus')
                    ->searchable(),
                TextColumn::make('rak.kode_rak')
                    ->sortable()
                    ->label('Kode Rak'),
                TextColumn::make('tingkat_perkembangan')
                    ->label('Tingkat Perkembangan')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('status')
                    ->boolean()
                    ->trueIcon('heroicon-s-check-circle')
                    ->falseIcon('heroicon-s-x-circle')
                    ->extraAttributes(['class' => 'flex justify-center'])
                    ->label('Retensi'),
                TextColumn::make('tahun')
                    ->sortable()
                    ->label('Tahun'),
            ])
            ->filters([
                //
            ]);
    }
}
