<?php

namespace App\Filament\Dosen\Resources\UserResource\Pages;

use Filament\Forms\Form;
use Filament\Actions\Action;
use App\Models\BimbinganUjian;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Dosen\Resources\UserResource;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Forms\Components\Section as ComponentsSection;

class infolistUjian extends Page implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.dosen.resources.user-resource.pages.infolist-ujian';

    protected static ?string $title = "Infolist Bimbingan Skripsi";

    public $record;

    public ?array $data = [];

    public $dosen;

    public function mount($record): void
    {
        $this->record = BimbinganUjian::where('user_id', $record)->first();
        $this->dosen = Auth::user()->id;
        $this->form->fill(BimbinganUjian::where('user_id', $record)->first()->attributesToArray());
    }

    public function infolistBimbinganSkripsi(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->record)
            ->schema([
                Section::make('Informasi Mahasiswa')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Nama'),
                        TextEntry::make('user.mahasiswaDetail.nim')
                            ->label('NIM')
                    ])
                    ->columns(),
                Section::make('Informasi Judul tugas Akhir')
                    ->schema([
                        TextEntry::make('judul.judul')
                    ])
                    ->columns(1),
                Section::make('Status Bimbingan')
                    ->schema([
                        TextEntry::make('status_dospem1')
                            ->label('Status Dospem 1')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'bimbingan' => 'warning',
                                'diterima' => 'success',
                            }),
                        TextEntry::make('status_dospem2')
                            ->label('Status Dospem 2')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'bimbingan' => 'warning',
                                'diterima' => 'success',
                            }),
                    ])
                    ->columns()
            ]);
    }

    public function form(Form $form): Form
    {
        if($this->record->dospem1_id === $this->dosen) {
            return $form
                ->schema([
                    ComponentsSection::make('Setujui')
                        ->schema([
                            Select::make('status_dospem1')
                                ->label('Status Dospem 1')
                                ->options([
                                    'bimbingan' => 'Bimbingan',
                                    'diterima' => 'Diterima'
                                ])
                        ])
                ])
                ->statePath('data');
        }

        if($this->record->dospem2_id === $this->dosen) {
            return $form
                ->schema([
                    ComponentsSection::make('Setujui')
                        ->schema([
                            Select::make('status_dospem2')
                                ->label('Status Dospem 2')
                                ->options([
                                    'bimbingan' => 'Bimbingan',
                                    'diterima' => 'Diterima'
                                ])
                        ])
                ])
                ->statePath('data');
        }
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if($this->record->dospem1_id === $this->dosen) {
            $this->record->update($data);
        }

        if($this->record->dospem2_id === $this->dosen) {
            $this->record->update($data);
        }

        Notification::make()
            ->success()
            ->title('Bimbingan Skripsi Telah Disetujui')
            ->send();
    }

    public function getFormActions() {
        return [
            Action::make('save')
                ->label('Setujui')
                ->submit('save')
        ];
    }
}
