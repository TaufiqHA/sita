<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Models\PengajuanProposal;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;

class SeminarProposal extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $view = 'filament.pages.seminar-proposal';

    protected static ?string $title = 'Pengajuan Seminar Proposal';

    protected static ?string $navigationGroup = 'Management Seminar Proposal';
    
    protected static ?string $navigationLabel = 'Pengajuan Seminar Proposal';

    public function table(Table $table): Table
    {
        return $table 
            ->query(PengajuanProposal::query()->where('status_pengajuan', 'Pending'))
            ->columns([
                TextColumn::make('mahasiswa.name'),
                TextColumn::make('tanggal_pengajuan')
                    ->date(),
                IconColumn::make('verifikasi')
                    ->boolean(),
            ])
            ->actions([
                ViewAction::make()
                    ->url(fn ($record) => ViewPengajuanSeminar::getUrl(['record' => $record->id])),
                // EditAction::make()
                //     ->url(fn ($record) => CreateSeminar::getUrl(['record' => $record->id]))
            ]);
    }
}
