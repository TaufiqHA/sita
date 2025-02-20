<?php

namespace App\Filament\Sekjur\Resources\UjianResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use App\Mail\NotifikasiJadwalUjian;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Sekjur\Resources\UjianResource;

class EditUjian extends EditRecord
{
    protected static string $resource = UjianResource::class;
    protected static ?string $title = 'Edit Ujian';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('jadwal')
                ->label('Rilis Jadwal')
                ->action(function() {
                    $mahasiswa = User::where('id', $this->record->user_id)->first();
                    Mail::to($mahasiswa->email)->send(new NotifikasiJadwalUjian($this->record));

                    Notification::make()
                        ->success()
                        ->title('Jadwal Telah Dirilis')
                        ->send();
                })
        ];
    }
}
