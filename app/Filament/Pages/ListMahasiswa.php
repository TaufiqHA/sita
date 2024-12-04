<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Pages\ListJudulMahasiswa;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Concerns\InteractsWithTable;

class ListMahasiswa extends Page implements HasTable
{
    use InteractsWithTable;
    protected static ?string $title = 'List Mahasiswa';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.list-mahasiswa';

    protected static ?string $navigationGroup = 'Management Judul';

    protected static ?string $navigationLabel = 'Pengajuan Judul';

    protected static ?string $model = Mahasiswa::class;

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
