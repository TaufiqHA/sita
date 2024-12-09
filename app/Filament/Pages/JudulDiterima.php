<?php

namespace App\Filament\Pages;

use App\Models\Judul;
use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Filament\Exports\JudulExporter;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Concerns\InteractsWithTable;

class JudulDiterima extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static string $view = 'filament.pages.judul-diterima';

    protected static ?string $navigationGroup = 'Management Judul';

    protected static ?int $navigationSort = 1;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         ExportAction::make()
    //             ->label('Export')
    //             ->exporter(PembimbingExporter::class),
    //     ];
    // }

    public function table(Table $table): Table {
        return $table
            ->query(Judul::query()->where('status', 'diterima'))
            ->columns([
                TextColumn::make('mahasiswa.name')
                    ->label('Nama Mahasiswa'),
                TextColumn::make('judul')
                    ->limit(70),
                TextColumn::make('pembimbing.dospem1.name')
                    ->label('Pembimbing 1'),
                TextColumn::make('pembimbing.dospem2.name')
                    ->label('Pembimbing 2'),
            ])
            ->headerActions([
                ExportAction::make()->exporter(JudulExporter::class)->label('Export')
            ]);
    }
}
