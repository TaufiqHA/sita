<?php

namespace App\Filament\Mahasiswa\Resources\PengajuanJudulResource\Pages;

use App\Filament\Mahasiswa\Resources\PengajuanJudulResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengajuanJuduls extends ListRecords
{
    protected static string $resource = PengajuanJudulResource::class;

    protected static ?string $title = 'Pengajuan Judul';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Ajukan Judul'),
        ];
    }
}
