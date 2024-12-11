<?php

namespace App\Filament\Mahasiswa\Resources\PengajuanHasilResource\Pages;

use App\Filament\Mahasiswa\Resources\PengajuanHasilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanHasil extends EditRecord
{
    protected static string $resource = PengajuanHasilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
