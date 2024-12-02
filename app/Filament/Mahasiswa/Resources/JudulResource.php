<?php

namespace App\Filament\Mahasiswa\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Judul;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Mahasiswa\Resources\JudulResource\Pages;
use App\Filament\Mahasiswa\Resources\JudulResource\RelationManagers;

class JudulResource extends Resource
{
    protected static ?string $model = Judul::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Management Judul';

    protected static ?string $navigationLabel = 'Pengajuan Judul';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('mahasiswa_id')
                    ->default(Auth::user()->id)
                    ->required(),
                Forms\Components\TextInput::make('judul')
                    ->required(),
                Forms\Components\FileUpload::make('outline')
                    ->required()
                    ->downloadable()
                    ->previewable(false)
                    ->directory('outline'),
                Forms\Components\Hidden::make('status')
                    ->default('diajukan')
                    ->required(),
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
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diajukan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListJuduls::route('/'),
            'create' => Pages\CreateJudul::route('/create'),
            'edit' => Pages\EditJudul::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('mahasiswa_id', Auth::user()->id);
    }
}
