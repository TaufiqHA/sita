<?php

namespace App\Filament\Mahasiswa\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\ujian;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use App\Filament\Mahasiswa\Resources\UjianResource\Pages;

class UjianResource extends Resource
{
    protected static ?string $model = ujian::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'Management Ujian';

    protected static ?string $navigationLabel = 'Pengajuan Ujian Munaqasya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('mahasiswa_id')
                    ->required()
                    ->default(Auth::user()->id),
                Forms\Components\Hidden::make('pembimbing_id')
                    ->required()
                    ->default(Auth::user()->pembimbing->id),
                Forms\Components\FileUpload::make('transkrip_nilai')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('lembar_konsul')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('berita_acara_kompren')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('lembar_nilai_kompren')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('bukti_pembayaran_spp')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('sertif_btq')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('sertif_piba')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('sertif_cbt')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('sertif_kkn')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('ijazah_sma')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('ijazah_smp')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('ijazah_sd')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('sertif_toefl')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('sk_bebas_pustaka')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('lembar_hafalan')
                    ->required()
                    ->directory('ujian')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\Hidden::make('tanggal_pengajuan')
                    ->required()
                    ->default(Carbon::now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_pengajuan')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Pending' => 'warning',
                        'Diterima' => 'success'
                    }),
                Tables\Columns\TextColumn::make('tanggal_pengajuan')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUjians::route('/'),
            'create' => Pages\CreateUjian::route('/create'),
            'edit' => Pages\EditUjian::route('/{record}/edit'),
        ];
    }
}
