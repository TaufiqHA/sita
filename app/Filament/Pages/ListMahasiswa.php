<?php

namespace App\Filament\Pages;

use App\Models\Settings;
use Filament\Pages\Page;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use App\Filament\Pages\ListJudulMahasiswa;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Concerns\InteractsWithTable;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class ListMahasiswa extends Page implements HasTable
{
    use InteractsWithTable, HasPageShield;
    protected static ?string $title = 'List Mahasiswa';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.list-mahasiswa';

    protected static ?string $navigationGroup = 'Management Judul';

    protected static ?string $navigationLabel = 'Pengajuan Judul';

    protected static ?string $model = Mahasiswa::class;

    protected static ?int $navigationSort = 0;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Pengaturan')
                ->form([
                    Toggle::make('pengajuan_judul')
                        ->label('Peganjuan Judul')
                        ->default(function () {
                            // Ambil nilai default dari database
                            return Settings::where('key', 'pengajuan_judul')->value('value') === 'true';
                        })
                        ->required(),
            ])
            ->action(function (array $data) {
                // Simpan ke database
                Settings::updateOrCreate(
                    ['key' => 'pengajuan_judul'], // Cari berdasarkan key
                    ['value' => $data['pengajuan_judul'] ? 'true' : 'false'] // Set value
                );
            }),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Mahasiswa::query()->whereHas('judul', function($query) {
                $query->where('status', 'diajukan');
            }))
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('nim')
                    ->searchable(),
                TextColumn::make('sks')
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(
                fn ($record) => ListJudulMahasiswa::getUrl(['record' => $record->id]),
            );
    }
}
