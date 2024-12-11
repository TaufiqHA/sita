<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Http\Request;
use App\Models\PengajuanHasil;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class ViewPengajuanSeminarHasil extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.view-pengajuan-seminar-hasil';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data;

    public function mount(Request $record): void
    {
        $this->form->fill(PengajuanHasil::where('id', $record->record)->first()->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('transkrip_nilai')
                    ->label('Transkrip Nilai yang Sudah Ditanda Tangani oleh Sekretaris Jurusan')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('transkrip_nilai')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('lembar_konsul')
                    ->label('Lembar Konsultasi Bimbingan')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('lembar_konsul')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('lembar_seminar')
                    ->label('Lembar Mengikuti Seminar')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('lembar_seminar')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('lembar_hafalan')
                    ->label('Lembar Hafalan Juz 30')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('lembar_hafalan')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('keterangan_plagiasi')
                    ->label('Surat Keterangan Plagiasi')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('keterangan_plagiasi')
                    ->label(false)
                    ->minHeight('100svh'),
                FileUpload::make('keterangan_pengumpulan_proposal')
                    ->label('Surat Keteranga Telah Mengumpulkan Proposal Dari Ruang Baca')
                    ->deletable(false)
                    ->downloadable(),
                PdfViewerField::make('keterangan_pengumpulan_proposal')
                    ->label(false)
                    ->minHeight('100svh'),
            ])
            ->statePath('data');
    }
}
