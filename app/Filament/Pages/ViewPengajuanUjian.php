<?php

namespace App\Filament\Pages;

use App\Models\ujian;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Http\Request;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use App\Filament\Pages\ujian as ujianPage;
use Filament\Forms\Concerns\InteractsWithForms;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class ViewPengajuanUjian extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.view-pengajuan-ujian';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $syaratData;

    public ?array $verifikasiData;

    public $ujianId;

    protected function getForms(): array
    {
        return [
            'syaratForm',
            'verifikasiForm',
        ];
    }

    public function mount(Request $record): void
    {
        $this->syaratForm->fill(ujian::where('id', $record->record)->first()->attributesToArray());
        $this->verifikasiForm->fill(ujian::where('id', $record->record)->first()->attributesToArray());
        $this->ujianId = $record->record;
    }

    public function syaratForm(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('transkrip_nilai')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('transkrip_nilai')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('lembar_konsul')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('lembar_konsul')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('berita_acara_kompren')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('berita_acara_kompren')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('lembar_nilai_kompren')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('lembar_nilai_kompren')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('bukti_pembayaran_spp')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('bukti_pembayaran_spp')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('sertif_btq')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('sertif_btq')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('sertif_piba')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('sertif_piba')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('sertif_cbt')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('sertif_cbt')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('sertif_kkn')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('sertif_kkn')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('ijazah_sma')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('ijazah_sma')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('ijazah_smp')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('ijazah_smp')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('ijazah_sd')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('ijazah_sd')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('sertif_toefl')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('sertif_toefl')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('sk_bebas_pustaka')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('sk_bebas_pustaka')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('lembar_hafalan')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('lembar_hafalan')
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

    public function save()
    {
        $data = $this->verifikasiForm->getState();

        ujian::where('id', $this->ujianId)->update($data);

        return redirect(ujianPage::getUrl());
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('cancel')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }
}
