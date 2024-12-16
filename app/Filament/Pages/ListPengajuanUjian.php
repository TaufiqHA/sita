<?php

namespace App\Filament\Pages;

use App\Models\ujian;
use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Filament\Pages\CreateUjian;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Columns\IconColumn;

class ListPengajuanUjian extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.list-pengajuan-ujian';

    protected static ?string $navigationGroup = 'Management Ujian';

    public function table(Table $table): Table
    {
        return $table
            ->query(ujian::query())
            ->columns([
                TextColumn::make('mahasiswa.name'),
                TextColumn::make('tanggal_pengajuan')
                    ->date(),
                TextColumn::make('status_jadwal')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Tidak Terjadwal' => 'danger',
                        'Terjadwal' => 'success',
                    })
            ])
            ->emptyStateHeading('Tidak Terdapat Pengajuan Ujian')
            ->actions([
                EditAction::make()
                    ->url(fn ($record) => CreateUjian::getUrl(['record' => $record->id])),
            ]);
    }
}
