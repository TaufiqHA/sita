<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use App\Models\PengajuanProposal;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class ViewPengajuanSeminar extends Page implements HasForms
{

    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.view-pengajuan-seminar';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public $proposal;

    public function mount(Request $record) {
        $this->proposal = PengajuanProposal::where('id', $record->record)->first();
        $this->form->fill(PengajuanProposal::where('id', $record->record)->first()->attributesToArray());
    }

    public function form(Form $form): Form
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
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('cancel')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.cancel.label'))
                ->submit('save'),
        ];
    }

    public function save()
    {
        return redirect('/admin/seminar-proposal');
    }
}
