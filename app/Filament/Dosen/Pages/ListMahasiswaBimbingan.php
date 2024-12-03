<?php

namespace App\Filament\Dosen\Pages;

use Filament\Pages\Page;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class ListMahasiswaBimbingan extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.dosen.pages.list-mahasiswa-bimbingan';

    protected static ?string $navigationLabel = 'Mahasiswa Bimbingan';

    protected static ?string $navigationGroup = 'Pembimbing';

    protected static ?string $title = 'Mahasiswa Bimbingan';

    protected static ?string $model = Mahasiswa::class;

    public function table(Table $table): Table {
        return $table
            ->query(Mahasiswa::query()->whereNotNull('dospem1')->whereNotNull('dospem2'))
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable(),
                TextColumn::make('pembimbing.status_dospem1')
                    ->label('Pembimbing 1')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bimbingan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
                TextColumn::make('pembimbing.status_dospem2')
                    ->label('Pembimbing 2')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bimbingan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
            ]);
    }
}
