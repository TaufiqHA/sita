<?php

namespace App\Filament\Dosen\Pages;

use App\Models\Judul;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\Pembimbing;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class DetailBimbingan extends Page implements HasForms
{

    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.dosen.pages.detail-bimbingan';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $judulData = [];
    public ?array $statusData = [];

    public $bimbingan;

    protected function getForms(): array
    {
        return [
            'editJudulForm',
            'editStatusForm',
        ];
    }

    public function mount(Request $record) {
        $this->editJudulForm->fill(Judul::where('mahasiswa_id', $record->record)->where('status', 'diterima')->first()->attributesToArray());
        $this->editStatusForm->fill(Pembimbing::where('mahasiswa_id', $record->record)->first()->attributesToArray());
        $this->bimbingan = Pembimbing::where('mahasiswa_id', $record->record)->first();
    }

    public function editJudulForm(Form $form): Form {
        return $form
            ->schema([
                TextInput::make('judul')
                    ->readOnly()
            ])
            ->statePath('judulData');
    }

    public function editStatusForm(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status_dospem1')
                    ->label('Status')
                    ->options([
                        'bimbingan' => 'Bimbingan',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak'
                    ])
                    ->visible(function () {
                        return $this->bimbingan->dospem1_id === Auth::user()->id;
                    }),
                Select::make('status_dospem2')
                    ->label('Status')
                    ->options([
                        'bimbingan' => 'Bimbingan',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak'
                    ])
                    ->visible(function () {
                        return $this->bimbingan->dospem2_id === Auth::user()->id;
                    }),
                ])
                ->statePath('statusData');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('Save Changes'))
                ->submit('save'),
        ];
    }

    public function save() {
        try {
            $data = $this->editStatusForm->getState();

            $this->bimbingan->update($data);

            return redirect(ListMahasiswaBimbingan::getUrl());
        } catch (Halt $exception) {
            return;
        }
    }
}
