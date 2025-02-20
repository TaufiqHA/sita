<?php

namespace App\Filament\Sekjur\Resources\UjianResource\Pages;

use App\Filament\Sekjur\Resources\UjianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUjians extends ListRecords
{
    protected static string $resource = UjianResource::class;
    protected static ?string $title = 'Ujian';

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
