<?php

namespace App\Filament\Mahasiswa\Widgets;

use Filament\Tables;
use App\Models\Pembimbing;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\TableWidget as BaseWidget;

class ProgressJudul extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(Pembimbing::where('mahasiswa_id', Auth::user()->id))
            ->columns([
                TextColumn::make('status_dospem1')
                    ->label('Status Pembimbing 1')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bimbingan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
                TextColumn::make('status_dospem2')
                    ->label('Status Pembimbing 2')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'bimbingan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
            ])
            ->paginated(false);
    }

    public function getColumnSpan(): int
    {
        return 2;
    }
}
