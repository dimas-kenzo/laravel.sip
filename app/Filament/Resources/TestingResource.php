<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Testing;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Resources\Tables\Columns;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TestingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TestingResource\RelationManagers;


class TestingResource extends Resource
{
    protected static ?string $model = Testing::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Wizard::make([
                Wizard\Step::make('Tahap 1')
                    ->schema([
                        TextInput::make('nip')->required()->label(__('NIP'))->numeric(),
                        TextInput::make('name')->required()->label(__('Nama Lengkap')),
                        TextInput::make('email')->required()->email(),
                    ]),
                Wizard\Step::make('Tahap 2')
                    ->schema([
                        TextInput::make('birthPlace')->required()->label(__('Tempat Lahir')),
                        DatePicker::make('birthDate')->displayFormat('d mm Y')->required()->label(__('Tanggal Lahir')),
                        Select::make('gender')->options([
                            'Pria' => 'Pria',
                            'Wanita' => 'Wanita'
                        ])->label(__('Jenis Kelamin'))->required(),
                    ]),
                Wizard\Step::make('Tahap 3')
                    ->schema([
                        Textarea::make('address')->required()->columnSpan('full'),
                        Repeater::make('workExperience')->label(__('Riwayat Pekerjaan'))
                        ->schema([
                            TextInput::make('pekerjaan sebelumnya')->required(),
                            Select::make('lama bekerja')->options(config('tm_config.workExperience'))->required(),
                        ])->columns(2)->collapsible()->columnSpan('full'),
                    ]),
            ])->columnSpan('full')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nip')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('birthPlace')->label(__('Tempat Lahir'))->sortable()->searchable(),
                TextColumn::make('birthDate')->label(__('Tempat Lahir'))->sortable()->searchable(),
                TextColumn::make('gender')->sortable()->searchable(),
                TextColumn::make('address')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListTestings::route('/'),
            'create' => Pages\CreateTesting::route('/create'),
            'edit' => Pages\EditTesting::route('/{record}/edit'),
        ];
    }
}
