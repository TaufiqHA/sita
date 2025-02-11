<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Filament\Http\Responses\Auth\LogoutResponse as BaseLogoutResponse;
 
class LogoutResponse extends BaseLogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        if (Filament::getCurrentPanel()->getId() === 'admin') {
            return redirect()->to('auth');
        }elseif (Filament::getCurrentPanel()->getId() === 'mahasiswa') {
            return redirect()->to('auth');
        }elseif (Filament::getCurrentPanel()->getId() === 'kajur') {
            return redirect()->to('auth');
        }elseif (Filament::getCurrentPanel()->getId() === 'sekjur') {
            return redirect()->to('auth');
        }elseif (Filament::getCurrentPanel()->getId() === 'dosen') {
            return redirect()->to('auth');
        }
 
        return parent::toResponse($request);
    }
}