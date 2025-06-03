<?php

namespace App\Filament\Mahasiswa\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PengajuanJudul;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Mahasiswa\Resources\PengajuanJudulResource\Pages;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use App\Filament\Mahasiswa\Resources\PengajuanJudulResource\RelationManagers;
use Illuminate\Database\Eloquent\Collection;

class PengajuanJudulResource extends Resource
{
    protected static ?string $model = PengajuanJudul::class;

    protected static ?string $navigationLabel = 'Pengajuan Judul';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id),
                Forms\Components\TextInput::make('judul')
                    ->required(),
                Forms\Components\FileUpload::make('outline')
                    ->required()
                    ->directory('/pengajuan_judul')
                    ->downloadable()
                    ->previewable(),
                PdfViewerField::make('outline')
                    ->label('View the PDF')
                    ->minHeight('60svh'),
                Forms\Components\Hidden::make('status')
                    ->default('diajukan'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(70),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diajukan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                BulkAction::make('delete')
                    ->requiresConfirmation()
                    ->action(fn (Collection $records) => $records->each->delete())
            ])
            ->emptyStateHeading('Tidak Ada Judul yang Diajukan');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengajuanJuduls::route('/'),
            'create' => Pages\CreatePengajuanJudul::route('/create'),
            'edit' => Pages\EditPengajuanJudul::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id);
    }
}
