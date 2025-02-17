<?php

namespace App\Filament\Dosen\Resources\UserResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Dosen\Resources\UserResource;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Status Bimbingan';

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
