<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use App\Models\PengajuanProposal;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class ViewPengajuanSeminar extends Page implements HasForms
{

    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.view-pengajuan-seminar';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $syaratData = [];
    public ?array $verifikasiData = [];

    public $proposal;

    protected function getForms(): array
    {
        return [
            'syaratForm',
            'verifikasiForm',
        ];
    }

    public function mount(Request $record) {
        $this->proposal = PengajuanProposal::where('id', $record->record)->first();
        $this->syaratForm->fill(PengajuanProposal::where('id', $record->record)->first()->attributesToArray());
        $this->verifikasiForm->fill(PengajuanProposal::where('id', $record->record)->first()->attributesToArray());
    }

    public function syaratForm(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('lembar_persetujuan')
                    ->downloadable()
                    ->deletable(false),
                PdfViewerField::make('lembar_persetujuan')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('katrol')
                    ->downloadable()
                    ->deletable(false),
                PdfViewerField::make('katrol')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('hasil_turnitin')
                    ->downloadable()
                    ->deletable(false),
                PdfViewerField::make('hasil_turnitin')
                    ->label(false)
                    ->minHeight('100svh'),
            ])
            ->statePath('syaratData');
    }

    public function verifikasiForm(Form $form): Form
    {
        return $form
            ->schema([
                Checkbox::make('verifikasi'),
            ])
            ->statePath('verifikasiData');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('cancel')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save()
    {
        $data = $this->verifikasiForm->getState();

        PengajuanProposal::where('id', $this->proposal->id)->update($data);

        return redirect(SeminarProposal::getUrl());
    }
}
