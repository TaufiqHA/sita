<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Seminar;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SeminarResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SeminarResource\RelationManagers;

class SeminarResource extends Resource
{
    protected static ?string $model = Seminar::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?string $navigationGroup = 'Manajemen Seminar';

    protected static ?string $navigationLabel = 'Seminar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jenis_seminar')
                    ->required()
                    ->options([
                        'proposal' => 'Proposal',
                        'hasil' => 'Hasil'
                    ])
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('user_id', null)),
                    
                Forms\Components\Select::make('user_id')
                    ->label('Nama Mahasiswa')
                    ->required()
                    ->options(function (callable $get) {
                        $jenisSeminar = $get('jenis_seminar');
                        
                        if (!$jenisSeminar) {
                            return [];
                        }
                        
                        if ($jenisSeminar === 'proposal') {
                            // Ambil mahasiswa yang sudah disetujui bimbingan proposalnya
                            $approvedUserIds = \App\Models\BimbinganProposal::where('status_dospem1', 'diterima')
                                ->where('status_dospem2', 'diterima')
                                ->pluck('user_id')
                                ->toArray();
                        } else { // hasil
                            // Ambil mahasiswa yang sudah disetujui bimbingan hasilnya
                            $approvedUserIds = \App\Models\BimbinganHasil::where('status_dospem1', 'diterima')
                                ->where('status_dospem2', 'diterima')
                                ->pluck('user_id')
                                ->toArray();
                        }
                        
                        // Ambil data user (mahasiswa) yang disetujui
                        return \App\Models\User::whereIn('id', $approvedUserIds)
                            ->whereHas('roles', fn (Builder $query) => $query->where('name', 'mahasiswa'))
                            ->pluck('name', 'id')
                            ->toArray();
                    }),
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
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->emptyStateHeading('Tidak Ada Seminar')
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
