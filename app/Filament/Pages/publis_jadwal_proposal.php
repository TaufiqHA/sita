<?php

namespace App\Filament\Pages;

use App\Models\Seminar;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Pembimbing;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use App\Models\PembimbingHasil;
use App\Filament\Pages\JadwalUjian;
use App\Mail\PengajuanProposalMail;
use Illuminate\Support\Facades\Mail;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;

class publis_jadwal_proposal extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Publish Jadwal';

    protected static string $view = 'filament.pages.publis_jadwal_proposal';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public $seminar;
    public function mount(Request $record)
    {
        $this->form->fill(Seminar::where('id', $record->record)->first()->attributesToArray());
        $this->seminar = Seminar::where('id', $record->record)->first();
    }

    public function form(Form $form): Form
    {
        return $form 
            ->schema([
                Fieldset::make('panitia')
                    ->schema([
                        TextInput::make('ketua')
                            ->readOnly(),
                        TextInput::make('sekretaris')
                            ->readOnly(),
                        TextInput::make('penguji1')
                            ->readOnly(),
                        TextInput::make('penguji2')
                            ->readOnly(),
                    ]),
                Fieldset::make('jadwal')
                    ->schema([
                        DatePicker::make('tanggal_seminar')
                            ->label('Tanggal Seminar')
                            ->readOnly(),
                        TimePicker::make('waktu_seminar')
                            ->label('Waktu Seminar')
                            ->readOnly(),
                        TextInput::make('ruangan')
                            ->label('Ruangan')
                            ->readOnly(),
                    ]),
                Fieldset::make('Publish Jadwal')
                    ->schema([
                        Checkbox::make('published')
                    ])
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

    public function save()
    {
        try {
            $data = $this->form->getState();

            $this->seminar->update([
                'published' => $data['published'],
            ]);

            if($this->seminar->published === true) {
                $mailData = [
                    'jenis' => 'Proposal',
                    'tanggal' => $data['tanggal_seminar'],
                    'waktu' => $data['waktu_seminar'],
                    'tempat' => $data['ruangan'],
                ];
    
                Mail::to($this->seminar->mahasiswa->email)->send(new PengajuanProposalMail($mailData));
    
                $pembimbing = Pembimbing::where('mahasiswa_id', $this->seminar->mahasiswa_id)->first();
    
                PembimbingHasil::insert([
                    'mahasiswa_id' => $pembimbing->mahasiswa_id,
                    'judul_id' => $pembimbing->judul_id,
                    'dospem1_id' => $pembimbing->dospem1->id,
                    'dospem2_id' => $pembimbing->dospem2->id,
                ]);
            }

            return redirect(JadwalUjian::getUrl());
        } catch (Halt $th) {
            return;
        }
    }
}