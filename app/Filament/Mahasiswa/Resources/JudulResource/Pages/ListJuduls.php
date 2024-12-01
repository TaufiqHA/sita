<?php

namespace App\Filament\Mahasiswa\Resources\JudulResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Mahasiswa\Resources\JudulResource;

class ListJuduls extends ListRecords
{
    protected static string $resource = JudulResource::class;

    public function getTitle(): string
    {
        return 'Judul';
    }

    protected function getHeaderActions(): array
    {
        if(Auth::user()->judul->count() < 3) {
            return [
                Actions\CreateAction::make()
                    ->label('Tambah Judul'),
            ]; 
        }

        return [];
    }
}
