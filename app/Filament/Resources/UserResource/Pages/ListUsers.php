<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
{
    return [
        'mahasiswa' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('roles', function($query) {
                $query->where('name', 'mahasiswa');
            })),
        'dosen' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('roles', function($query) {
                $query->whereIn('name', ['kajur', 'sekjur', 'dosen']);
            })),
    ];
}


}
