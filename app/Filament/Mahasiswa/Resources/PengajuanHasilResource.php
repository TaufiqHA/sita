<?php

namespace App\Filament\Mahasiswa\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Judul;
use Filament\Forms\Form;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use App\Models\PengajuanHasil;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Mahasiswa\Resources\PengajuanHasilResource\Pages;
use App\Filament\Mahasiswa\Resources\PengajuanHasilResource\RelationManagers;

class PengajuanHasilResource extends Resource
{
    protected static ?string $model = PengajuanHasil::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationLabel = 'Pengajuan Seminar Hasil';

    protected static ?string $navigationGroup = 'Management Seminar';

    protected static ?int $navigationSort = 1;

    public static function shouldRegisterNavigation(): bool
    {
        $mahasiswa = Mahasiswa::where('id', auth('mahasiswa')->user()->id)->first()->pembimbingHasil;
        if($mahasiswa !== null) {
            $status = auth(guard: 'mahasiswa')->user()->pembimbingHasil;
            if($status->status_dospem1 === 'diterima' && $status->status_dospem2 === 'diterima') {
                return true;
            }
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
                Forms\Components\FileUpload::make('transkrip_nilai')
                    ->label('Transkrip Nilai yang Sudah ditanda tangani oleh Sekretaris Jurusan')
                    ->required()
                    ->directory('hasil')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('lembar_konsul')
                    ->label('Lembar Konsultasi Bimbingan')
                    ->required()
                    ->directory('hasil')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('lembar_seminar')
                    ->label('Lembar Mengikuti Seminar')
                    ->required()
                    ->directory('hasil')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('lembar_hafalan')
                    ->label('Lembar Hafalan Juz 30')
                    ->required()
                    ->directory('hasil')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('keterangan_plagiasi')
                    ->label('Surat Keterangan Plagiasi')
                    ->required()
                    ->directory('hasil')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\FileUpload::make('keterangan_pengumpulan_proposal')
                    ->label('Surat Ketaranga Telah Mengumpulkan Proposal Dari Ruang Baca')
                    ->required()
                    ->directory('hasil')
                    ->acceptedFileTypes(['application/pdf']),
                Forms\Components\DatePicker::make('tanggal_pengajuan'),
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
                Tables\Columns\TextColumn::make('status_pengajuan')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Pending' => 'warning',
                        'Disetujui' => 'success',
                    })
                    ->sortable(),
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
            'index' => Pages\ListPengajuanHasils::route('/'),
            'create' => Pages\CreatePengajuanHasil::route('/create'),
            'edit' => Pages\EditPengajuanHasil::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('mahasiswa_id', Auth::user()->id);
    }
}
