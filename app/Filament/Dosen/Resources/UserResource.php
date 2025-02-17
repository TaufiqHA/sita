<?php

namespace App\Filament\Dosen\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Dosen\Resources\UserResource\Pages;
use App\Filament\Dosen\Resources\UserResource\Pages\infolistHasil;
use App\Filament\Dosen\Resources\UserResource\Pages\InfolistJudul;
use App\Filament\Dosen\Resources\UserResource\Pages\infolistUjian;
use App\Filament\Dosen\Resources\UserResource\RelationManagers;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Status Bimbingan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
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
            ->actions([
                ActionGroup::make([
                    Action::make('proposal')
                        ->label('Proposal')
                        ->url(fn (Model $record): string => InfolistJudul::getUrl([$record->id])),
                    Action::make('hasil')
                        ->label('Hasil')
                        ->url(fn (Model $record): string => infolistHasil::getUrl([$record->id])),
                    Action::make('ujian')
                        ->label('Ujian')
                        ->url(fn (Model $record): string => infolistUjian::getUrl([$record->id])),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'infolistJudul' => InfolistJudul::route('/{record}/infolistJudul'),
            'infolistBimbinganHasil' => infolistHasil::route('/{record}/infolistBimbinganHasil'),
            'infolistBimbinganSkripsi' => infolistUjian::route('/{record}/infolistBimbinganSkripsi'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $dosen_id = Auth::user()->id;

        return parent::getEloquentQuery()->whereHas('judul', function($query) use ($dosen_id) {
            $query->where('dospem1_id', $dosen_id)
                  ->orWhere('dospem2_id', $dosen_id);
        });
    }
}
