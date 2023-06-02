<?php

namespace App\Filament\Resources\RakResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ArsipRelationManager extends RelationManager
{
    protected static string $relationship = 'arsip';

    protected static ?string $recordTitleAttribute = 'rak_id';

    protected function getTableQuery(): Builder
    {
        if(auth()->user()->hasRole('super_admin')){
            return parent::getTableQuery();
        }
        return parent::getTableQuery()->where('unit_kerja_id', Auth::user()->unit_kerja_id);
    }

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
                TextColumn::make('tanggal_arsip')
                    ->sortable()
                    ->label('Tanggal Arsip'),
            ])
            ->filters([
                //
            ]);
    }
}
