<?php

namespace App\Filament\Mahasiswa\Resources\JudulResource\Pages;

use App\Filament\Mahasiswa\Resources\JudulResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJudul extends EditRecord
{
    protected static string $resource = JudulResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}