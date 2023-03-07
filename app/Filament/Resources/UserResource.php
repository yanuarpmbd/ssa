<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use STS\FilamentImpersonate\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getRecordRouteKeyName(): string
    {
        return 'identifier';
    }

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    protected static function getNavigationLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getPluralLabel(): string
    {
        return trans('filament-user::user.resource.label');
    }

    public static function getLabel(): string
    {
        return trans('filament-user::user.resource.single');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('filament-user.group');
    }

    protected function getTitle(): string
    {
        return trans('filament-user::user.resource.title.resource');
    }

    public static function form(Form $form): Form
    {
        $rows = [
            TextInput::make('name')->required()->label(trans('filament-user::user.resource.name')),
            TextInput::make('email')->email()->required()->label(trans('filament-user::user.resource.email')),
            TextInput::make('nip')->length(9)->required()->label('NIP (Pendek)'),
            TextInput::make('jabatan')->required()->label('Jabatan'),
            Select::make('unit_kerja_id')
                ->relationship('unitKerja', 'nama_unit_kerja')
                ->label('Unit Kerja')
                ->searchable()
                ->preload()
                ->required(),
            Toggle::make('status')
                ->inline(false)
                ->onIcon('heroicon-s-check-circle')
                ->offIcon('heroicon-s-x-circle')
                ->label('Status (aktif/inaktif)')
                ->required(),
            Forms\Components\TextInput::make('password')->label(trans('filament-user::user.resource.password'))
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(static function ($state) use ($form) {
                    if (!empty($state)) {
                        return Hash::make($state);
                    }

                    $user = User::find($form->getColumns());
                    if ($user) {
                        return $user->password;
                    }
                }),
        ];

        if (config('filament-user.shield')) {
            $rows[] = Forms\Components\MultiSelect::make('roles')->relationship('roles', 'name')->label(trans('filament-user::user.resource.roles'));
        }

        $form->schema($rows);

        return $form;
    }

    public static function table(Table $table): Table
    {
        $table
            ->columns([
                TextColumn::make('id')->sortable()->label(trans('filament-user::user.resource.id')),
                TextColumn::make('name')->sortable()->searchable()->label(trans('filament-user::user.resource.name')),
                TextColumn::make('email')->sortable()->searchable()->label(trans('filament-user::user.resource.email')),
                TextColumn::make('nip')->searchable()->label('NIP'),
                TextColumn::make('jabatan')->searchable()->label('Jabatan'),
                TextColumn::make('unitKerja.nama_unit_kerja')
                    ->sortable()
                    ->label('Unit Kerja')
                    ->wrap(),
                IconColumn::make('status')
                    ->boolean()
                    ->trueIcon('heroicon-s-check-circle')
                    ->falseIcon('heroicon-s-x-circle')
                    ->extraAttributes(['class' => 'flex justify-center'])
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')->label(trans('filament-user::user.resource.created_at'))
                    ->dateTime('M j, Y')->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label(trans('filament-user::user.resource.updated_at'))
                    ->dateTime('M j, Y')->sortable()->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                Tables\Filters\Filter::make('aktif')
                    ->label('Aktif')
                    ->query(fn (Builder $query): Builder => $query->where('status', '1')),
                Tables\Filters\Filter::make('inaktif')
                    ->label('Non Aktif')
                    ->query(fn (Builder $query): Builder => $query->where('status', '')),
            ]);

        if (config('filament-user.impersonate')) {
            $table->prependActions([
                Impersonate::make('impersonate'),
            ]);
        }

        return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record:identifier}/edit'),
        ];
    }
}
