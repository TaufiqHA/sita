<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Models\PengajuanProposal;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class SeminarProposal extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $view = 'filament.pages.seminar-proposal';

    protected static ?string $navigationGroup = 'Management Seminar';

    public function table(Table $table): Table
    {
        return $table 
            ->query(PengajuanProposal::query()->where('status_pengajuan', 'Pending'))
            ->columns([
                TextColumn::make('mahasiswa.name'),
                TextColumn::make('status_pengajuan')
            ])
            ->recordUrl(
                fn ($record) => CreateSeminar::getUrl(['record' => $record->id])
            );
    }
}
