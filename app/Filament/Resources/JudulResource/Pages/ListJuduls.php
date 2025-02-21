<?php

namespace App\Filament\Resources\JudulResource\Pages;

use App\Filament\Resources\JudulResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListJuduls extends ListRecords
{
    protected static string $resource = JudulResource::class;

    protected static ?string $title = 'Judul Diterima';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export')
                ->label('Export to Excel')
                ->url('/export')
                ->openUrlInNewTab()
        ];
    }
}
