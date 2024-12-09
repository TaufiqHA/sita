<?php

namespace App\Filament\Mahasiswa\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Judul;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\PengajuanProposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Mahasiswa\Resources\PengajuanProposalResource\Pages;
use App\Models\Pembimbing;

class PengajuanProposalResource extends Resource
{
    protected static ?string $model = PengajuanProposal::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'Management Seminar';

    protected static ?string $navigationLabel = 'Pengajuan Seminar Proposal';

    public static function shouldRegisterNavigation(): bool
    {
        $status = Pembimbing::where('mahasiswa_id', Auth::user()->id)->first();
        if($status->status_dospem1 && $status->status_dospem2 === 'diterima') {
            return true;
        }
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('mahasiswa_id')
                    ->required()
                    ->default(Auth::user()->id),
                Forms\Components\Hidden::make('judul_id')
                    ->required()
                    ->default(Judul::where('mahasiswa_id', Auth::user()->id)->first()->id),
                Forms\Components\FileUpload::make('lembar_persetujuan')
                    ->directory('proposal'),
                Forms\Components\FileUpload::make('katrol')
                    ->directory('proposal'),
                Forms\Components\FileUpload::make('hasil_turnitin')
                    ->directory('proposal'),
                Forms\Components\DatePicker::make('tanggal_pengajuan'),
                Forms\Components\Hidden::make('status_pengajuan')
                    ->required()
                    ->default('Pending'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal_pengajuan')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_pengajuan'),
            ])
            ->paginated(false)
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
            'index' => Pages\ListPengajuanProposals::route('/'),
            'create' => Pages\CreatePengajuanProposal::route('/create'),
            'edit' => Pages\EditPengajuanProposal::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('mahasiswa_id', Auth::user()->id);
    }
}
