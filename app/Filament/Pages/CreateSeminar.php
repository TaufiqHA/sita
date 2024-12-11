<?php

namespace App\Filament\Pages;

use App\Models\Seminar;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use App\Models\PembimbingHasil;
use App\Models\PengajuanProposal;
use App\Mail\PengajuanProposalMail;
use App\Models\Pembimbing;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Select;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateSeminar extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.create-seminar';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public $proposal;

    public function mount(Request $record) {
        $this->proposal = PengajuanProposal::where('id', $record->record)->first();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal_seminar')
                    ->label('Tanggal Seminar')
                    ->required(),
                TimePicker::make('waktu_seminar')
                    ->label('Waktu Seminar')
                    ->required(),
                TextInput::make('ruangan')
                    ->label('Ruangan')
                    ->required(),

                ])
                ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/create-record.form.actions.create.label'))
                ->submit('save'),
        ];
    }

    public function save() {
        try {
            $data = $this->form->getState();

            Seminar::insert([
                'proposal_id' => $this->proposal->id,
                'jenis_seminar' => 'Proposal',
                'waktu_seminar' => $data['waktu_seminar'],
                'tanggal_seminar' => $data['tanggal_seminar'],
                'ruangan' => $data['ruangan'],
            ]);

            $this->proposal->update([
                'status_pengajuan' => 'Disetujui'
            ]);

            $mailData = [
                'jenis' => 'Proposal',
                'tanggal' => $data['tanggal_seminar'],
                'waktu' => $data['waktu_seminar'],
                'tempat' => $data['ruangan'],
            ];

            Mail::to($this->proposal->mahasiswa->email)->send(new PengajuanProposalMail($mailData));

            $pembimbing = Pembimbing::where('mahasiswa_id', $this->proposal->mahasiswa_id)->first();

            PembimbingHasil::insert([
                'mahasiswa_id' => $pembimbing->mahasiswa_id,
                'judul_id' => $pembimbing->judul_id,
                'dospem1_id' => $pembimbing->dospem1->id,
                'dospem2_id' => $pembimbing->dospem2->id,
            ]);

            return redirect('/admin/seminar-proposal');
        } catch (Halt $exception) {
            return;
        }
    }
}
