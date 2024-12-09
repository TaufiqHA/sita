<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;

class MahasiswaPage extends Page implements HasTable
{
    use HasPageShield, InteractsWithTable;

    protected static ?string $title = 'Mahasiswa';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static string $view = 'filament.pages.mahasiswa-page';

    protected static ?string $navigationLabel = 'Mahasiswa';

    protected static ?string $navigationGroup = 'Bimbingan';

    public function table(Table $table): Table {
        return $table
            ->query(Mahasiswa::query())
            ->columns([
                Split::make([
                    TextColumn::make('name')
                        ->searchable(),
                    TextColumn::make('nim')
                        ->searchable(),
                    Stack::make([
                        TextColumn::make('pembimbing.dospem1.name'),
                        TextColumn::make('pembimbing.status_dospem1')
                            ->label('Pembimbing 1')
                            ->badge()
                            ->color(fn ($state) => match ($state) {
                                'bimbingan' => 'warning',
                                'diterima' => 'success',
                                'ditolak' => 'danger'
                            }),
                        ]),
                    Stack::make([
                        TextColumn::make('pembimbing.dospem2.name'),
                        TextColumn::make('pembimbing.status_dospem2')
                            ->label('Pembimbing 2')
                            ->badge()
                            ->color(fn ($state) => match ($state) {
                                'bimbingan' => 'warning',
                                'diterima' => 'success',
                                'ditolak' => 'danger'
                            }),
                        ]),
                ])
            ]);
    }

}
