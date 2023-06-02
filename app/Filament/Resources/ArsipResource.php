<?php

namespace App\Filament\Resources;

use App\Models\Arsip;
use App\Models\Dus;
use App\Exports\ArsipExport;
use App\Filament\Resources\ArsipResource\Pages;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use Illuminate\Support\Facades\Auth;


class ArsipResource extends Resource
{
    protected static ?string $model = Arsip::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive';

    protected static ?string $navigationGroup = 'Arsip';

    protected static ?string $navigationLabel = 'Dokumen';

    protected static ?string $label = 'Dokumen';

    protected static ?string $pluralLabel = 'Dokumen';

    protected static ?string $recordTitleAttribute = 'nama_arsip';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kode_arsip')
                    ->relationship('jenisArsip', 'kode_jenis')
                    ->label('Kode Klasifikasi Arsip')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('unit_kerja_id')
                    ->relationship('unitKerja', 'nama_unit_kerja')
                    ->label('Unit Kerja')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nama_arsip')
                    ->label('Nama Dokumen')
                    ->disableAutocomplete()
                    ->required(),
                Select::make('rak_id')
                    ->relationship('rak', 'nama_rak')
                    ->label('Nama Rak')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->reactive(),
                Select::make('dus_id')
                    ->relationship('dus', 'nama_dus')
                    ->label('Kode Dus')
                    ->options(function (\Closure $get) {
                        $dus = Dus::where('rak_id', $get('rak_id'))->pluck('nama_dus', 'id');
                        return $dus;
                    })
                    ->label('Nama Dus')
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('tanggal_arsip')
                    ->label('Tanggal Arsip')
                    ->required(),
                Grid::make()->schema([
                    Toggle::make('status')
                        ->inline(false)
                        ->onIcon('heroicon-s-check-circle')
                        ->offIcon('heroicon-s-x-circle')
                        ->label('Retensi (aktif/inaktif)')
                        ->required(),
                    Radio::make('tingkat_perkembangan')
                        ->options([
                            'Asli' => 'Asli',
                            'Fotocopy' => 'Fotocopy',
                        ])
                        ->label('Tingkat Perkembangan')
                        ->required(),
                ])->columns(2),
                Grid::make()->schema([
                    MarkDownEditor::make('deskripsi'),
                ])->columns(1),
                Grid::make()->schema([
                    FileUpload::make('upload_arsip')
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('public')
                        ->directory('Arsip/' . Carbon::now()->format('F Y'))
                        ->preserveFilenames()
                        ->label('Upload Arsip'),
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
            ->defaultSort('tanggal_arsip')
            ->filters([
                SelectFilter::make('kode_arsip')
                    ->relationship('jenisArsip', 'kode_jenis')
                    ->label('Kode Arsip')
                    ->searchable(),
                SelectFilter::make('unit_kerja')
                    ->relationship('unitKerja', 'nama_unit_kerja')
                    ->label('Unit Kerja')
                    ->searchable(),
                SelectFilter::make('rak')
                    ->relationship('rak', 'kode_nama')
                    ->label('Rak')
                    ->searchable(),
                SelectFilter::make('dus')
                    ->relationship('dus', 'nama_dus')
                    ->label('Dus')
                    ->searchable(),
                Filter::make('tanggal_arsip')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_arsip', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_arsip', '<=', $date),
                            );
                    })
                    ->label('Tanggal Arsip'),
                SelectFilter::make('tingkat_perkembangan')
                    ->options([
                        'asli' => 'Asli',
                        'fotocopy' => 'Fotocopy',
                    ])
                    ->label('Tingkat Perkembangan'),
                Filter::make('Arsip Aktif')
                    ->query(fn (Builder $query): Builder => $query->where('status', true)),
                Filter::make('Arsip Inaktif')
                    ->query(fn (Builder $query): Builder => $query->where('status', false)),
            ])

            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('unitKerja.nama_unit_kerja')->heading('Unit Kerja'),
                        Column::make('nama_arsip'),
                        Column::make('jenisArsip.kode_jenis')->heading('Jenis Arsip'),
                        Column::make('dus.nama_dus')->heading('Nama Dus'),
                        Column::make('rak.kode_rak')->heading('Nama Rak'),
                        Column::make('tingkat_perkembangan'),
                        Column::make('tanggal_arsip'),
                    ])
                ])
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
            'index' => Pages\ListArsips::route('/'),
            'arsipaktif' => Pages\ArsipAktifs::route('/arsipaktif'),
            'create' => Pages\CreateArsip::route('/create'),
            'edit' => Pages\EditArsip::route('/{record}/edit'),
            'view' => Pages\ViewArsip::route('/{record}'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        if(auth()->user()->hasRole('super_admin')){
            return static::getModel()::count();
        }
        return static::getModel()::query()->where('unit_kerja_id', Auth::user()->unit_kerja_id)->count();
    }
}
