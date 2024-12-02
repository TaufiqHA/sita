<?php

namespace App\Filament\Pages;

use App\Models\Dosen;
use App\Models\Judul;
use Filament\Pages\Page;
use App\Models\Mahasiswa;
use App\Models\Pembimbing;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Concerns\InteractsWithTable;

class ListJudulMahasiswa extends Page implements HasTable
{
    use InteractsWithTable;

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.list-judul-mahasiswa';

    protected static ?string $model = Judul::class;

    public $mahasiswa;

    public function mount($record) {
        $this->mahasiswa = Mahasiswa::where('id', $record)->first();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Judul::query()->where('mahasiswa_id', $this->mahasiswa->id))
            ->columns([
                TextColumn::make('judul')
                    ->searchable()
                    ->limit(70),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diajukan' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        TextInput::make('judul')
                            ->required(),
                        FileUpload::make('outline')
                            ->required()
                            ->downloadable()
                            ->previewable(false)
                            ->deletable(false),
                        Select::make('status')
                            ->options([
                                'diterima' => 'Diterima',
                                'ditolak' => 'Ditolak',
                                'ditinjau' => 'Ditinjau',
                                'diajukan' => 'Diajukan'
                            ])
                            ->reactive()
                            ->required(),
                        Section::make()
                            ->schema([
                                Select::make('dospem1_id')
                                    ->options(Dosen::all()->pluck('name', 'id')),
                                Select::make('dospem2_id')
                                    ->options(Dosen::all()->pluck('name', 'id')),
                            ])
                            ->hidden(fn ($get) => in_array($get('status'), ['diajukan', 'ditolak', 'ditinjau'])),
                    ])
                    ->after(function ($record, $data) {
                        $this->save($data, $record->id);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function save($data, $id) {
        try {
            if($data['status'] === 'diterima') {
                Pembimbing::create([
                    'mahasiswa_id' => $this->mahasiswa->id,
                    'judul_id' => $id,
                    'dospem1_id' => $data['dospem1_id'],
                    'dospem2_id' => $data['dospem2_id'],
                ]);

                Judul::where('mahasiswa_id', $this->mahasiswa->id)->where('status', 'diajukan')->update(['status' => 'ditolak']);

                return redirect('/admin/list-mahasiswa');
            }
        } catch (Halt $exception) {
            return;
        }

    }
}
