<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use App\Models\PengajuanHasil;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use App\Filament\Pages\ListPengajuanHasil;
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
                Fieldset::make('panitia')
                    ->schema([
                        TextInput::make('ketua'),
                        TextInput::make('sekretaris'),
                        TextInput::make('penguji1'),
                        TextInput::make('penguji2'),
                    ]),
                Fieldset::make('jadwal')
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
                'mahasiswa_id' => $this->hasil->mahasiswa->id,
                'hasil_id' => $this->hasil->id,
                'jenis_seminar' => 'Hasil',
                'ketua' => $data['ketua'],
                'sekretaris' => $data['sekretaris'],
                'penguji1' => $data['penguji1'],
                'penguji2' => $data['penguji2'],
                'dospem1_id' => $this->hasil->mahasiswa->pembimbing->dospem1->id,
                'dospem2_id' => $this->hasil->mahasiswa->pembimbing->dospem2->id,
                'waktu_seminar' => $data['waktu_seminar'],
                'tanggal_seminar' => $data['tanggal_seminar'],
                'ruangan' => $data['ruangan'],
            ]);

            $this->hasil->update([
                'status_pengajuan' => 'Disetujui',
                'status_jadwal' => 'Terjadwal'
            ]);

            return redirect(ListPengajuanHasil::getUrl());
        } catch (Halt $exception) {
            return;
        }
    }
}
