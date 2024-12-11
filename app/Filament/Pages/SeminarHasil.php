<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Models\PengajuanHasil;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Filament\Pages\ViewPengajuanSeminarHasil;
use Filament\Tables\Actions\EditAction;

class SeminarHasil extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $view = 'filament.pages.seminar-hasil';

    protected static ?string $navigationGroup = 'Management Seminar';

    protected static ?int $navigationSort = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(PengajuanHasil::query()->where('status_pengajuan', 'Pending'))
            ->columns([
                TextColumn::make('mahasiswa.name')
                    ->searchable(),
                TextColumn::make('status_pengajuan')
            ])
            ->actions([
                ViewAction::make()
                    ->url(fn ($record) => ViewPengajuanSeminarHasil::getUrl(['record' => $record->id])),
                EditAction::make()
                    ->url(fn ($record) => CreateSeminarHasil::getUrl(['record' => $record->id]))
            ]);
    }
}
