<?php

namespace App\Filament\Mahasiswa\Resources\PengajuanProposalResource\Pages;

use App\Filament\Mahasiswa\Resources\PengajuanProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanProposal extends EditRecord
{
    protected static string $resource = PengajuanProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
