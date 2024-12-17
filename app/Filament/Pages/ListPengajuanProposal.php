<?php

namespace App\Filament\Pages;

use App\Models\PengajuanProposal;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;

class ListPengajuanProposal extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.list-pengajuan-proposal';

    protected static ?string $navigationGroup = 'Manajement Seminar Proposal';

    public function table(Table $table): Table
    {
        return $table
            ->query(PengajuanProposal::query())
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
                    ->url(fn ($record) => CreateSeminar::getUrl(['record' => $record->id]))
            ]);
    }
}
