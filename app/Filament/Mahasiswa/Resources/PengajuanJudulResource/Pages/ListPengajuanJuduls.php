<?php

namespace App\Filament\Mahasiswa\Resources\PengajuanJudulResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Mahasiswa\Resources\PengajuanJudulResource;

class ListPengajuanJuduls extends ListRecords
{
    protected static string $resource = PengajuanJudulResource::class;

    protected static ?string $title = 'Pengajuan Judul';

    protected function getHeaderActions(): array
    {
        if(Auth::user()->pengajuanJudul->count() && Auth::user()->pengajuanJudul->count() === 3) {
            return [];
        }

        if(Auth::user()?->mahasiswaDetail?->sks == null) {

            Notification::make()
                ->danger()
                ->title('Lengkapi SKS')
                ->send();

            return [];
        }

        if(Auth::user()->mahasiswaDetail->sks < 144) {
            Notification::make()
            ->title('SKS Belum Mencukupi')
            ->danger()
            ->send();

            return [];
        }

        if(Auth::user()->pengajuanJudul->where('status', 'diterima')->count()) {
            return [];
        }

        return [
            Actions\CreateAction::make()
                ->label('Ajukan Judul'),
        ];
    }
}
