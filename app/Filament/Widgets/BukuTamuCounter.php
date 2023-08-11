<?php

namespace App\Filament\Widgets;

use App\Models\BukuTamu;
use App\Models\User;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class BukuTamuCounter extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    protected static ?string $heading = 'Buku Tamu';

    public function getDefaultTableRecordsPerPageSelectOption(): int
    {
        return 5;
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'buku_tamu_count';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }


    protected function getTableQuery(): Builder
    {
        $data = User::withCount('bukuTamu');
        return $data;
        //dd(BukuTamu::select('user_id')->selectRaw('COUNT(*) AS aggregate')->groupBy('user_id')->orderByDesc('aggregate')->get());
        //return BukuTamu::select('user_id')->selectRaw('COUNT(*) AS aggregate')->groupBy('user_id')->orderByDesc('aggregate');
        //return BukuTamu::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->sortable()->searchable()->label(trans('filament-user::user.resource.name')),
            TextColumn::make('unitKerja.nama_unit_kerja')
                ->label('Unit Kerja')
                ->wrap(),
            TextColumn::make('jabatan')
                ->label('Jabatan'),
            TextColumn::make('buku_tamu_count')
                ->label('Jumlah Tamu')
                ->sortable(),
        ];
    }
}
