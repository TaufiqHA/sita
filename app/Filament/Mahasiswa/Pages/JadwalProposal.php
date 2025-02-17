<?php

namespace App\Filament\Mahasiswa\Pages;

use App\Models\User;
use App\Models\Seminar;
use Filament\Pages\Page;
use Filament\Infolists\Infolist;
use Illuminate\Support\Facades\Auth;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Concerns\InteractsWithInfolists;

class JadwalProposal extends Page implements HasInfolists
{
    use InteractsWithInfolists;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.mahasiswa.pages.jadwal-proposal';

    public $record;

    public $mahasiswa;

    public function mount(): void
    {
        $this->mahasiswa = Auth::user()->id;
        $this->record = Seminar::where('user_id', $this->mahasiswa)->where('jenis_seminar', 'proposal')->first();
    }

    public function infolistJadwalProposal(Infolist $infolist): Infolist
    {
        $user = User::where('id', Auth::user()->id)->first();
        if($user->seminar->count()) {
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
                    Section::make('Tanggal dan Tempat')
                        ->schema([
                            TextEntry::make('tanggal')
                                ->label('Tanggal'),
                            TextEntry::make('ruangan')
                                ->label('Tempat'),
                        ])
                        ->columns(),
                    Section::make('Penguji')
                        ->schema([
                            TextEntry::make('penguji1')
                                ->label('Penguji 1'),
                            TextEntry::make('penguji2')
                                ->label('Penguji 2'),
                        ])
                        ->columns()
                ]);
        } else {
            return $infolist
                ->schema([
                    //
                ]);
        }
    }
}
