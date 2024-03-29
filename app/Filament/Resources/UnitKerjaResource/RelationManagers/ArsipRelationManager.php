<?php

namespace App\Filament\Resources\UnitKerjaResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;


class ArsipRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'arsip';

    protected static ?string $recordTitleAttribute = 'unit_kerja_id';

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
