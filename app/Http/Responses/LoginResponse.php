<?php

namespace App\Http\Responses;

use Filament\Pages\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Filament\Http\Responses\Auth\LoginResponse as BaseLoginResponse;
 
class LoginResponse extends BaseLoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        if (Auth::user()->roles->contains('name', 'super_admin')) {
            return redirect()->to(Dashboard::getUrl(panel: 'admin'));
        }elseif (Auth::user()->roles->contains('name', 'mahasiswa')) {
            return redirect()->to(Dashboard::getUrl(panel: 'mahasiswa'));
        }elseif (Auth::user()->roles->contains('name', 'kajur')) {
            return redirect()->to(Dashboard::getUrl(panel: 'kajur'));
        }elseif (Auth::user()->roles->contains('name', 'sekjur')) {
            return redirect()->to(Dashboard::getUrl(panel: 'sekjur'));
        }elseif (Auth::user()->roles->contains('name', 'dosen')) {
            return redirect()->to(Dashboard::getUrl(panel: 'dosen'));
        }
 
        return parent::toResponse($request);
    }
}