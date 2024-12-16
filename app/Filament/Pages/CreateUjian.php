<?php

namespace App\Filament\Pages;

use App\Models\ujian;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use App\Models\UjianMunaqasya;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use App\Filament\Pages\ListPengajuanUjian;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Log;

class CreateUjian extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $title = 'Panitia dan Jadwal Ujian';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.create-ujian';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public $ujian;

    public function mount(Request $record): void
    {
        $this->ujian = ujian::where('id', $record->record)->first();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Panitia')
                    ->schema([
                        TextInput::make('ketua')
                            ->required(),
                        TextInput::make('sekretaris')
                            ->required(),
                        TextInput::make('munaqisy1')
                            ->label('Munaqisy 1')
                            ->required(),
                        TextInput::make('munaqisy2')
                            ->label('Munaqisy 2')
                            ->required(),
                    ]),
                Fieldset::make('Jadwal')
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

    public function save()
    {
        try {
            $data = $this->form->getState();

            UjianMunaqasya::create([
                'mahasiswa_id' => $this->ujian->mahasiswa->id,
                'hasil_id' => $this->ujian->mahasiswa->hasil->id,
                'ujian_id' => $this->ujian->id,
                'ketua' => $data['ketua'],
                'sekretaris' => $data['sekretaris'],
                'munaqisy1' => $data['munaqisy1'],
                'munaqisy2' => $data['munaqisy2'],
                'dospem1_id' => $this->ujian->mahasiswa->pembimbing->dospem1->id,
                'dospem2_id' => $this->ujian->mahasiswa->pembimbing->dospem2->id,
                'tanggal_seminar' => $data['tanggal_seminar'],
                'waktu_seminar' => $data['waktu_seminar'],
                'ruangan' => $data['ruangan'],
            ]);

            $this->ujian->update([
                'status_jadwal' => 'Terjadwal',
            ]);
    
            return redirect(ListPengajuanUjian::getUrl());
        } catch (Halt $th) {
            return;
        }
    }
}