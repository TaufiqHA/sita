<?php

namespace App\Filament\Mahasiswa\Resources\PengajuanHasilResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Mahasiswa\Resources\PengajuanHasilResource;

class ListPengajuanHasils extends ListRecords
{
    protected static string $resource = PengajuanHasilResource::class;

    protected function getHeaderActions(): array
    {
        if(optional(Auth::user()->hasil)->exists()) {
            return [];
        }
        return [
            Actions\CreateAction::make()
                ->label('Ajukan'),
        ];
    }

    public function getTitle(): string
    {
        return 'Pengajuan Seminar Hasil';
    }
}
