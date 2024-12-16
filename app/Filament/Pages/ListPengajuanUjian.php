<?php

namespace App\Filament\Pages;

use App\Models\ujian;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Actions\EditAction;

class ListPengajuanUjian extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.list-pengajuan-ujian';

    protected static ?string $navigationGroup = 'Management Ujian';

    public function table(Table $table): Table
    {
        return $table
            ->query(ujian::where('verifikasi', true))
            ->columns([
                TextColumn::make('mahasiswa.name'),
                TextColumn::make('tanggal_pengajuan')
                    ->date(),
            ])
            ->actions([
                EditAction::make()
                    ->url(fn ($record) => CreateUjian::getUrl(['record' => $record->id])),
            ]);
    }
}
