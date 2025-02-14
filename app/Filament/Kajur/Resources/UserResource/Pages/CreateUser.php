<?php

namespace App\Filament\Kajur\Resources\UserResource\Pages;

use App\Filament\Kajur\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
