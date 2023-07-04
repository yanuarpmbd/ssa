<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ArsipResource;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestArsips extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    protected static ?string $heading = 'Dokumen Arsip Terbaru';

    public function getDefaultTableRecordsPerPageSelectOption(): int
    {
        return 5;
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'created_at';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function getTableQuery(): Builder
    {
        return ArsipResource::getEloquentQuery();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('unitKerja.nama_unit_kerja')
                ->sortable()
                ->label('Unit Kerja')
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('nama_arsip')
                ->sortable()
                ->label('Nama Dokumen')
                ->wrap()
                ->searchable(),
            Tables\Columns\TextColumn::make('jenisArsip.kode_jenis')
                ->sortable()
                ->wrap()
                ->label('Kode Klasifikasi'),
            Tables\Columns\TextColumn::make('dus.nama_dus')
                ->sortable()
                ->label('Kode Dus'),
            Tables\Columns\TextColumn::make('rak.kode_rak')
                ->sortable()
                ->label('Kode Rak'),
            Tables\Columns\TextColumn::make('tingkat_perkembangan')
                ->label('Tingkat Perkembangan')
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\BooleanColumn::make('status')
                ->trueIcon('heroicon-s-check-circle')
                ->falseIcon('heroicon-s-x-circle')
                ->extraAttributes(['class' => 'flex justify-center'])
                ->label('Retensi'),
            Tables\Columns\TextColumn::make('tahun')
                ->sortable()
                ->label('Tahun'),
        ];
    }
}
