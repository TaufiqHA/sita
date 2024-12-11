<?php

namespace App\Filament\Dosen\Pages;

use Filament\Pages\Page;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class ListMahasiswaBimbinganHasil extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $title = "Mahasiswa Bimbingan Hasil";

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.dosen.pages.list-mahasiswa-bimbingan-hasil';

    protected static ?string $navigationGroup = 'Pembimbing';

    protected static ?string $navigationLabel = 'Mahasiswa Bimbingan Hasil';

    public function table(Table $table): Table
    {
        return $table
            ->query(Mahasiswa::query()->whereHas('pembimbingHasil', function($query) {
                $query->where('dospem1_id', Auth::user()->id)->orWhere('dospem2_id', Auth::user()->id);
            }))
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                    TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable(),
                TextColumn::make('pembimbingHasil.status_dospem1')
                    ->label('Pembimbing 1')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bimbingan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
                TextColumn::make('pembimbingHasil.status_dospem2')
                    ->label('Pembimbing 2')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bimbingan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
            ])
            ->recordUrl(
                fn ($record) => DetailBimbinganHasil::getUrl(['record' => $record->id])
            );
    }
}
