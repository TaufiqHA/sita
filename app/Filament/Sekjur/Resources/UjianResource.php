<?php

namespace App\Filament\Sekjur\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Ujian;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Sekjur\Resources\UjianResource\Pages;
use App\Filament\Sekjur\Resources\UjianResource\RelationManagers;

class UjianResource extends Resource
{
    protected static ?string $model = Ujian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                        modifyQueryUsing: fn () => User::whereHas('roles', function ($query) {
                            $query->where('name', 'mahasiswa');
                        })->whereHas('bimbinganUjian', function($query) {
                            $query->where('status_dospem1', 'diterima')->where('status_dospem2', 'diterima');
                        })
                    ),
                Forms\Components\DatePicker::make('tanggal'),
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
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ruangan')
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
            ->emptyStateHeading('Tidak Ada Ujian!')
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
            'index' => Pages\ListUjians::route('/'),
            'create' => Pages\CreateUjian::route('/create'),
            'edit' => Pages\EditUjian::route('/{record}/edit'),
        ];
    }
}
