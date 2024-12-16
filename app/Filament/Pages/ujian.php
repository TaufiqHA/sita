<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Models\ujian as ujianModel;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use App\Filament\Pages\ViewPengajuanUjian;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class ujian extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;

    protected static ?string $title = "Pengajuan Ujian Munaqasya";

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.ujian';

    protected static ?string $navigationGroup = 'Management Ujian';

    protected static ?string $navigationLabel = 'Pengajuan Ujian Munaqasya';

    public function table(Table $table): Table
    {
        return $table
            ->query(ujianModel::query()->where('status_pengajuan', 'Pending'))
            ->columns([
                TextColumn::make('mahasiswa.name')
                    ->searchable(),
                TextColumn::make('status_pengajuan'),
                IconColumn::make('verifikasi')
                    ->boolean()
            ])
            ->actions([
                ViewAction::make()
                    ->url(fn ($record) => ViewPengajuanUjian::getUrl(['record' => $record->id])),
                // EditAction::make()
                //     ->url(fn ($record) => CreateSeminarHasil::getUrl(['record' => $record->id]))
            ]);
    }
}
