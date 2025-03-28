<?php

namespace App\Filament\Resources\SeminarResource\Pages;

use App\Filament\Resources\SeminarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeminars extends ListRecords
{
    protected static string $resource = SeminarResource::class;

    protected static ?string $title = 'Manajemen Seminar';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Seminar'),
        ];
    }
}
