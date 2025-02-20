<?php

namespace App\Filament\Kajur\Resources\UserResource\Pages;

use App\Models\User;
use App\Models\Judul;
use Filament\Forms\Form;
use Filament\Actions\Action;
use App\Mail\NotifikasiJudul;
use App\Models\BimbinganHasil;
use App\Models\BimbinganUjian;
use App\Models\PengajuanJudul;
use Filament\Infolists\Infolist;
use App\Models\BimbinganProposal;
use Filament\Resources\Pages\Page;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Kajur\Resources\UserResource;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Forms\Components\Section as ComponentsSection;

class AcceptJudul extends Page implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.kajur.resources.user-resource.pages.accept-judul';
    protected static ?string $title = 'Setujui Judul';

    public ?array $data = [];

    public $judul;

    public function mount($record): void
    {
        $this->judul = PengajuanJudul::findOrFail($record);
    }

    public function judulInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->judul)
            ->schema([
                Section::make('Informasi Mahasiswa')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Nama'),
                        TextEntry::make('user.mahasiswaDetail.nim')
                            ->label('NIM')
                    ])
                    ->columns(),
                Section::make('Informasi Judul Tugas Akhir')
                    ->schema([
                        TextEntry::make('judul')
                    ])
            ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                ComponentsSection::make('Pembimbing')
                    ->schema([
                        Select::make('dospem1_id')
                            ->label('Pembimbing 1')
                            ->options(
                                User::whereHas('roles', function($query) {
                                    $query->where('name', 'dosen');
                                })->pluck('name', 'id')
                            ),
                        Select::make('dospem2_id')
                            ->label('Pembimbing 2')
                            ->options(
                                User::whereHas('roles', function($query) {
                                    $query->where('name', 'dosen');
                                })->pluck('name', 'id')
                            )
                    ])
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // insert data ke database
        Judul::create([
            'user_id' => $this->judul->user_id,
            'judul' => $this->judul->judul,
            'dospem1_id' => $data['dospem1_id'],
            'dospem2_id' => $data['dospem2_id'],
            'tanggal_disetujui' => now()
        ]);

        $mahasiswa = $this->judul->user;

        $judul =  Judul::where('user_id', $mahasiswa->id)->first();

        // membuat bimbingan proposal
        BimbinganProposal::create([
            'user_id' => $this->judul->user_id,
            'judul_id' => $judul->id,
            'dospem1_id' => $data['dospem1_id'],
            'dospem2_id' => $data['dospem2_id'],
            'status_dospem1' => 'bimbingan',
            'status_dospem2' => 'bimbingan',
        ]);

        // membuat bimbingan hasil
        BimbinganHasil::create([
            'user_id' => $this->judul->user_id,
            'judul_id' => $judul->id,
            'dospem1_id' => $data['dospem1_id'],
            'dospem2_id' => $data['dospem2_id'],
            'status_dospem1' => 'bimbingan',
            'status_dospem2' => 'bimbingan',
        ]);

        // membuat bimbingan ujian
        BimbinganUjian::create([
            'user_id' => $this->judul->user_id,
            'judul_id' => $judul->id,
            'dospem1_id' => $data['dospem1_id'],
            'dospem2_id' => $data['dospem2_id'],
            'status_dospem1' => 'bimbingan',
            'status_dospem2' => 'bimbingan',
        ]);

        // kirim notifikasi
        Notification::make() 
            ->success()
            ->title('Judul Disetujui')
            ->send();

        //kirim email notifikasi
        Mail::to('htaufiq225@gmail.com')->send(new NotifikasiJudul($judul));

        $this->judul->update([
            'status' => 'diterima'
        ]);

        PengajuanJudul::where('user_id', $this->judul->user->id)->where('status', 'diajukan')->update([
            'status' => 'ditolak'
        ]);
    }

}
