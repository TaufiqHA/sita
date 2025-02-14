<?php

namespace App\Filament\Kajur\Resources\UserResource\Pages;

use App\Filament\Kajur\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Pengajuan Judul Tugas Akhir';

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
