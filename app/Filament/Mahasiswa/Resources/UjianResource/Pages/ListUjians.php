<?php

namespace App\Filament\Mahasiswa\Resources\UjianResource\Pages;

use App\Filament\Mahasiswa\Resources\UjianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUjians extends ListRecords
{
    protected static string $resource = UjianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
