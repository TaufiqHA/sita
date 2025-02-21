<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JudulResource\Pages;
use App\Filament\Resources\JudulResource\RelationManagers;
use App\Models\Judul;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JudulResource extends Resource
{
    protected static ?string $model = Judul::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-center-left';

    protected static ?string $navigationLabel = 'Judul Diterima';

    protected static ?string $navigationGroup = 'Manajemen Judul';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('judul')
                    ->required(),
                Forms\Components\TextInput::make('dospem1_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('dospem2_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tanggal_disetujui')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Nama Mahasiswa")
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(70),
            ])
            ->filters([
                //
            ])
            ->recordUrl(false)
            ->actions([
                Action::make('Detail')
                    ->modalHeading('Judul Tugas Akhir')
                    ->modalSubmitAction(false)
                    ->infolist([
                        Section::make('Informasi Mahasiswa')
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Nama'),
                                TextEntry::make('user.mahasiswaDetail.nim')
                                    ->label('NIM')
                            ])
                            ->columns(),
                        Section::make('Informasi Judul')
                            ->schema([
                                TextEntry::make('judul')
                                    ->label('Judul')
                            ]),
                        Section::make('Dosen Pembimbing')
                            ->schema([
                                TextEntry::make('dospem1.name')
                                    ->label('Dosen Pembimbing 1'),
                                TextEntry::make('dospem2.name')
                                    ->label('Dosen Pembimbing 2'),
                            ])
                            ->columns()
                    ])
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
}
