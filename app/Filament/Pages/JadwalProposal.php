<?php

namespace App\Filament\Pages;

use App\Models\Seminar;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class JadwalProposal extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static string $view = 'filament.pages.jadwal-proposal';

    protected static ?string $navigationGroup = 'Management Seminar Proposal';

    protected static ?int $navigationSort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(Seminar::query())
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
            ]);
    }
}
