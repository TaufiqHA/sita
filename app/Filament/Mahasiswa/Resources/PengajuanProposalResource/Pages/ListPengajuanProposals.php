<?php

namespace App\Filament\Mahasiswa\Resources\PengajuanProposalResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Mahasiswa\Resources\PengajuanProposalResource;

class ListPengajuanProposals extends ListRecords
{
    protected static string $resource = PengajuanProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return 'Pengajuan Seminar Proposal';
    }
}
