<?php

namespace App\Filament\Mahasiswa\Pages;

use Filament\Pages\Page;
use App\Models\BimbinganHasil;
use Filament\Infolists\Infolist;
use Illuminate\Support\Facades\Auth;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Concerns\InteractsWithInfolists;

class StatusHasil extends Page implements HasInfolists
{
    use InteractsWithInfolists;
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static string $view = 'filament.mahasiswa.pages.status-hasil';

    protected static ?string $title = 'Status Bimbingan Hasil';

    protected static ?string $navigationLabel = 'Status Bimbingan Hasil';

    public $record;

    public ?array $data = [];

    public $mahasiswa;

    public function mount(): void
    {
        $this->mahasiswa = Auth::user()->id;
        $this->record = BimbinganHasil::where('user_id', $this->mahasiswa)->first();
        $this->form->fill(BimbinganHasil::where('user_id', $this->mahasiswa)->first()->attributesToArray());
    }

    public function infolistBimbinganHasil(Infolist $infolist): Infolist
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
}
