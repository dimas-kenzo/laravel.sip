<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pegawai;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PegawaiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PegawaiResource\RelationManagers;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nip')->required()->label(__('NIP'))->numeric(),
                        TextInput::make('name')->required()->label(__('Nama Lengkap')),
                        TextInput::make('email')->required()->email(),
                        TextInput::make('nik')->required()->label(__('NIK'))->numeric(),
                        TextInput::make('birth-place')->required()->label(__('Tempat Lahir')),
                        DatePicker::make('birth-date')->displayFormat('d mm Y')->required()->label(__('Tanggal Lahir')),
                        Select::make('gender')->options([
                            'Pria' => 'Pria', 
                            'Wanita' => 'Wanita'
                        ])->label(__('Jenis Kelamin'))->required(),
                        TextInput::make('phone-number')->required()->label(__('Telepon / Whatsapp'))->tel()->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                        Select::make('position')->options([
                            'Layanan' => 'Layanan', 
                            'Research & Development' => 'Research & Development', 
                            'Produksi' => 'Produksi'
                        ])->required(),
                        Select::make('status')->options([
                            'Lajang' => 'Lajang', 
                            'Menikah' => 'Menikah'
                        ])->required(),
                        Textarea::make('address')->required()->columnSpan('full'),
                        Repeater::make('Riwayat Pekerjaan')
                            ->schema([
                                TextInput::make('work-experience')->required()->label(__('Pekerjaan Sebelumnya')),
                                Select::make('years-of-experience')
                                    ->options([
                                        '<1th' => '< 1 Tahun',
                                        '1th' => '1 Tahun',
                                        '2th' => '2 Tahun',
                                        '>2th' => '> 2 Tahun',
                                    ])
                                    ->required()->label(__('Lama Bekerja'))
                            ])
                            ->columns(2)->collapsible()->columnSpan('full'),
                        FileUpload::make('photo')->label(__('Pas Foto'))->columnSpan('full'),
                        FileUpload::make('cv')->label(__('Curriculum Vitae'))->columnSpan('full'),
                        FileUpload::make('supporting-documents')->label(__('Sertifikat Pendukung'))->columnSpan('full'),
                        FileUpload::make('last-diploma')->label(__('Ijazah Terakhir'))->columnSpan('full'),
                        FileUpload::make('transcript')->label(__('Transkrip Nilai'))->columnSpan('full'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListPegawais::route('/'),
            'create' => Pages\CreatePegawai::route('/create'),
            'edit' => Pages\EditPegawai::route('/{record}/edit'),
        ];
    }
}
