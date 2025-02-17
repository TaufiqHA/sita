<?php

namespace App\Filament\Sekjur\Resources\SeminarResource\Pages;

use App\Filament\Sekjur\Resources\SeminarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeminars extends ListRecords
{
    protected static string $resource = SeminarResource::class;

    protected static ?string $title = 'Seminar';

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
