<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuTamuResource\Pages;
use App\Filament\Resources\BukuTamuResource\RelationManagers;
use App\Models\BukuTamu;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use App\Models\User;
use Closure;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

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
                    ->disableautocomplete()
                    ->required(),
                TextInput::make('no_telp')
                    ->mask(fn (TextInput\Mask $mask) => $mask->pattern('0000-0000-0000-0')->numeric())
                    ->disableautocomplete()
                    ->required(),
                TextInput::make('asal_instansi')
                    ->disableautocomplete()
                    ->required(),
                Select::make('user_id')
                    ->label('Nama yang dituju')
                    ->options(User::where('status', '1')->pluck('name', 'id'))
                    ->required(),
                Select::make('keperluan')
                    ->options([
                        'dinas' => 'Keperluan Dinas',
                        'pribadi' => 'Keperluan Pribadi',
                    ])
                    ->reactive()
                    ->required(),
                FileUpload::make('file_upload')
                    ->disk('public')
                    ->directory('BukuTamu/' . Carbon::now()->format('F Y'))
                    ->label('File Upload')
                    ->hidden(fn (Closure $get) => $get('keperluan') == 'pribadi' or $get('keperluan') == null),
                Grid::make()->schema([
                    Textarea::make('keterangan')
                        ->disableAutocomplete()
                        ->required(),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('no_telp')
                    ->label('Nomor Telepon'),
                TextColumn::make('asal_instansi')
                    ->label('Asal Instansi'),
                TextColumn::make('user.name')
                    ->sortable()
                    ->wrap()
                    ->label('Nama yg dituju'),
                TextColumn::make('keperluan')
                    ->enum([
                        'dinas' => 'Keperluan Dinas',
                        'pribadi' => 'Keperluan Pribadi',
                    ]),
                TextColumn::make('created_at')->label('Waktu Kunjungan'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('waktu_kunjungan')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('Tahun'),
                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Nama yg dituju')
                    ->searchable(),
                SelectFilter::make('keperluan')
                    ->options([
                        'dinas' => 'Keperluan Dinas',
                        'pribadi' => 'Keperluan Pribadi',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(),
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
