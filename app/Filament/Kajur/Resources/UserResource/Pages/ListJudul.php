<?php

namespace App\Filament\Kajur\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Tables\Table;
use App\Models\PengajuanJudul;
use Filament\Resources\Pages\Page;
use function Laravel\Prompts\form;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Kajur\Resources\UserResource;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Components\Section as ComponentsSection;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class ListJudul extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.kajur.resources.user-resource.pages.list-judul';

    public $user;

    public function mount($record): void
    {
        $this->user = User::findOrFail($record);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PengajuanJudul::query()->where('user_id', $this->user->id)
            )
            ->columns([
                TextColumn::make('judul')
                    ->limit(70),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diajukan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
            ])
            ->actions([
                Action::make('Detail')
                    ->infolist([
                        Section::make('Informasi Mahasiswa')
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Nama'),
                                TextEntry::make('user.mahasiswaDetail.nim')
                                    ->label('NIM'),
                            ])
                            ->columns(),
                        Section::make('Informasi Tugas Akhir')
                            ->schema([
                                TextEntry::make('judul')
                                    ->label('Judul'),
                                PdfViewerEntry::make('outline')
                                    ->label('Outline')
                                    ->minHeight('60svh')

                            ])
                            ->columns(1),
                        ]),
                Action::make('Setujui')
                    ->url(fn (Model $record) => AcceptJudul::getUrl([$record->id])),
            ]);
    }
}
