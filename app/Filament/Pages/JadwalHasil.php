<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Models\SeminarHasil;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class JadwalHasil extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static string $view = 'filament.pages.jadwal-hasil';

    protected static ?string $navigationGroup = 'Management Seminar Hasil';

    protected static ?int $navigationSort = 13;

    public function table(Table $table): Table
    {
        return $table
            ->query(SeminarHasil::query())
            ->columns([
                TextColumn::make('mahasiswa.name'),
                TextColumn::make('tanggal_seminar')
                    ->date(),
                TextColumn::make('waktu_seminar')
                    ->time(),
                IconColumn::make('published')
                    ->boolean()
            ])
            ->actions([
                EditAction::make()
                    ->url(fn ($record) => PublishJadwalHasil::getUrl(['record' => $record->id]))
            ]);
    }
}
