<?php

namespace App\Filament\Kajur\Resources;

use App\Filament\Kajur\Resources\UserResource\Pages\ListJudul;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Kajur\Resources\UserResource\Pages;
use App\Filament\Kajur\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pengajuan Judul';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mahasiswaDetail.nim')
                    ->label('NIM')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordUrl(
                fn (Model $record): string => ListJudul::getUrl([$record->id]),
            )
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'listJudul' => Pages\ListJudul::route('/{record}/listJudul'),
            'acceptJudul' => Pages\AcceptJudul::route('/{record}/acceptJudul'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('roles', function($query) {
            $query->where('name', 'mahasiswa');
        })->whereHas('pengajuanJudul', function($query){
            $query->where('status', 'diajukan');
        });
    }
}
