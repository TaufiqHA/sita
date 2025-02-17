<?php

namespace App\Filament\Sekjur\Resources;

use App\Filament\Sekjur\Resources\SeminarResource\Pages;
use App\Filament\Sekjur\Resources\SeminarResource\RelationManagers;
use App\Models\Seminar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeminarResource extends Resource
{
    protected static ?string $model = Seminar::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?string $navigationLabel = 'Seminar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Nama Mahasiswa')
                    ->required()
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->whereHas('roles', function($query) {
                            $query->where('name', 'mahasiswa');
                        })
                    ),
                Forms\Components\TextInput::make('jenis_seminar')
                    ->required(),
                Forms\Components\DatePicker::make(name: 'tanggal'),
                Forms\Components\TextInput::make('ruangan'),
                Forms\Components\TextInput::make('penguji1')
                    ->label('Penguji 1'),
                Forms\Components\TextInput::make('penguji2')
                    ->label('Penguji 2'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Mahasiswa')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_seminar')
                    ->label('Jenis Seminar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ruangan')
                    ->label('Ruangan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('penguji1')
                    ->label('Penguji 1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('penguji2')
                    ->label('Penguji 2')
                    ->searchable(),
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
            'index' => Pages\ListSeminars::route('/'),
            'create' => Pages\CreateSeminar::route('/create'),
            'edit' => Pages\EditSeminar::route('/{record}/edit'),
        ];
    }
}
