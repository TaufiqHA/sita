<?php

namespace App\Filament\Pages;

use App\Models\UjianMunaqasya;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;

class JadwalUjian extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static string $view = 'filament.pages.jadwal-ujian';

    protected static ?string $navigationGroup = 'Management Ujian';

    protected static ?string $navigationLabel = 'Jadwal Ujian';

    protected static ?int $navigationSort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(UjianMunaqasya::query())
            ->columns([
                TextColumn::make('mahasiswa.name'),
                TextColumn::make('tanggal_seminar')
                    ->label('Tanggal Ujian')
                    ->date(),
                TextColumn::make('waktu_seminar')
                    ->label('Waktu Ujian')
                    ->time(),
            ])
            ->actions([
                EditAction::make()
            ]);
    }
}
