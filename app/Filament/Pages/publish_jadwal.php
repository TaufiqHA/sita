<?php

namespace App\Filament\Pages;

use App\Mail\jadwal_mail;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use App\Models\UjianMunaqasya;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Select;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;

class publish_jadwal extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $title = 'Publish Jadwal';

    protected static string $view = 'filament.pages.publish_jadwal';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public $ujian;

    public function mount(Request $record): void
    {
        $this->form->fill(UjianMunaqasya::where('id', $record->record)->first()->attributesToArray());
        $this->ujian = UjianMunaqasya::where('id', $record->record)->first();
        // dd(UjianMunaqasya::where('id', $record->record)->first());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Panitia')
                    ->schema([
                        TextInput::make('ketua')
                            ->readOnly(),
                        TextInput::make('sekretaris')
                            ->readOnly(),
                        TextInput::make('munaqisy1')
                            ->label('Munaqisy 1')
                            ->readOnly(),
                        TextInput::make('munaqisy2')
                            ->label('Munaqisy 2')
                            ->readOnly(),
                    ]),
                Fieldset::make('Jadwal')
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

            $this->ujian->update([
                'published' => $data['published'],
            ]);

            if($this->ujian->published === true) {
                $mailData = [
                    'tanggal_ujian' => $this->ujian->tanggal_seminar,
                    'waktu_ujian' => $this->ujian->waktu_seminar,
                    'ruangan' => $this->ujian->ruangan
                ];
    
                Mail::to($this->ujian->mahasiswa->email)->send(new jadwal_mail($mailData));
            }

            return redirect(JadwalUjian::getUrl());
        } catch (Halt $th) {
            return;
        }
    }
}
