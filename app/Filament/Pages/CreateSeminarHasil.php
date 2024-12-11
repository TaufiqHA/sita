<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use App\Models\PengajuanHasil;
use App\Mail\PengajuanHasilMail;
use App\Filament\Pages\SeminarHasil;
use Illuminate\Support\Facades\Mail;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\SeminarHasil as SeminarHasilModel;

class CreateSeminarHasil extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.create-seminar-hasil';

    protected static bool $shouldRegisterNavigation = false;

    public $hasil;

    public ?array $data = [];

    public function mount(Request $record): void
    {
        $this->hasil = PengajuanHasil::where('id', $record->record)->first();
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

            SeminarHasilModel::create([
                'hasil_id' => $this->hasil->id,
                'waktu_seminar' => $data['waktu_seminar'],
                'tanggal_seminar' => $data['tanggal_seminar'],
                'ruangan' => $data['ruangan'],
            ]);

            $this->hasil->update([
                'status_pengajuan' => 'Disetujui'
            ]);

            $mailData = [
                'jenis' => 'Hasil',
                'tanggal' => $data['tanggal_seminar'],
                'waktu' => $data['waktu_seminar'],
                'tempat' => $data['ruangan'],
            ];

            Mail::to($this->hasil->mahasiswa->email)->send(new PengajuanHasilMail($mailData));

            // $pembimbing = Pembimbing::where('mahasiswa_id', $this->proposal->mahasiswa_id)->first();

            // PembimbingHasil::insert([
            //     'mahasiswa_id' => $pembimbing->mahasiswa_id,
            //     'judul_id' => $pembimbing->judul_id,
            //     'dospem1_id' => $pembimbing->dospem1->id,
            //     'dospem2_id' => $pembimbing->dospem2->id,
            // ]);

            return redirect(SeminarHasil::getUrl());
        } catch (Halt $exception) {
            return;
        }
    }
}
