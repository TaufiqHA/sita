<?php

namespace App\Filament\Sekjur\Resources\SeminarResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;
use App\Mail\NotifikasiJadwalSempro;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Sekjur\Resources\SeminarResource;

class EditSeminar extends EditRecord
{
    protected static string $resource = SeminarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('jadwal')
                ->label('Rilis Jadwal')
                ->action(function() {
                    $mahasiswa = User::where('id', $this->record->user_id)->first();
                    Mail::to($mahasiswa->email)->send(new NotifikasiJadwalSempro($this->record));

                    Notification::make()
                        ->success()
                        ->title('Jadwal Telah Dirilis')
                        ->send();
                })
        ];
    }
}
