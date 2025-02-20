<?php

namespace App\Filament\Sekjur\Resources\UjianResource\Pages;

use App\Filament\Sekjur\Resources\UjianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUjian extends EditRecord
{
    protected static string $resource = UjianResource::class;
    protected static ?string $title = 'Edit Ujian';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
