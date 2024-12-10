<?php

namespace App\Filament\Mahasiswa\Widgets;

use Filament\Tables;
use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Widgets\TableWidget as BaseWidget;

class ProgressJudul extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(Pembimbing::where('mahasiswa_id', Auth::user()->id))
            ->columns([
                Split::make([
                    Stack::make([
                        TextColumn::make('dospem1.name'),
                        TextColumn::make('status_dospem1')
                            ->label('Status Pembimbing 1')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'bimbingan' => 'warning',
                                'diterima' => 'success',
                                'ditolak' => 'danger',
                            }),
                        ]),
                    Stack::make([
                        TextColumn::make('dospem2.name'),
                        TextColumn::make('status_dospem2')
                            ->label('Status Pembimbing 2')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'bimbingan' => 'warning',
                                'diterima' => 'success',
                                'ditolak' => 'danger',
                            }),
                        ]),
                    ]),
                
            ])
            ->paginated(false);
    }

    public function getColumnSpan(): int
    {
        return 2;
    }

    public static function canView(): bool
    {
        $mahasiswa = Mahasiswa::where('id', auth('mahasiswa')->user()->id)->first()->pembimbing;
        if($mahasiswa !== null) {
            return true;
        }
        
        return false;
    }

}
