<?php

namespace App\Filament\Mahasiswa\Resources\UjianResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Mahasiswa\Resources\UjianResource;

class ListUjians extends ListRecords
{
    protected static string $resource = UjianResource::class;

    protected function getHeaderActions(): array
    {
        if(optional(Auth::user()->ujian)->exists()) {
            return [];
        }
        return [
            Actions\CreateAction::make()
                ->label('Ajukan'),
        ];
    }

    public function getTitle(): string
    {
        return 'Pengajuan Ujian Munaqasyah';
    }
}
