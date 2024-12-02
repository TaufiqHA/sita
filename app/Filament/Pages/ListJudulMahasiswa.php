<?php

namespace App\Filament\Pages;

use App\Models\Judul;
use Filament\Pages\Page;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Concerns\InteractsWithTable;

class ListJudulMahasiswa extends Page implements HasTable
{
    use InteractsWithTable;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.list-judul-mahasiswa';

    protected static ?string $model = Judul::class;

    public $mahasiswa;

    public function mount($record) {
        $this->mahasiswa = Mahasiswa::where('id', $record)->first();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Judul::query()->where('mahasiswa_id', $this->mahasiswa->id))
            ->columns([
                TextColumn::make('judul')
                    ->searchable()
                    ->limit(70),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diajukan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
