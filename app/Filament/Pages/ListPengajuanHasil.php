<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Filament\Pages\CreateSeminar;
use App\Models\PengajuanHasil;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class ListPengajuanHasil extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.list-pengajuan-hasil';

    protected static ?string $navigationGroup = 'Manajement Seminar Hasil';

    protected static ?int $navigationSort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(PengajuanHasil::query())
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
            ->actions([
                EditAction::make()
                    ->url(fn ($record) => CreateSeminarHasil::getUrl(['record' => $record->id]))
            ]);
    }
}
