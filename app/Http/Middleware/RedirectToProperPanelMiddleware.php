<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Filament\Pages\Dashboard;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectToProperPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('filament.*.auth.logout')) {
            return $next($request);
        }
        
        if (Auth::check()) {
            $user = Auth::user();
            $roles = [
                'super_admin' => 'admin',
                'mahasiswa'   => 'mahasiswa',
                'kajur'       => 'kajur',
                'sekjur'      => 'sekjur',
                'dosen'       => 'dosen',
            ];

            foreach ($roles as $role => $panel) {
                if ($user->roles->contains('name', $role)) {
                    $redirectUrl = Dashboard::getUrl(panel: $panel);
                    if (url()->current() !== $redirectUrl) { 
                        return redirect()->to($redirectUrl);
                    }
                }
            }
        }

        return $next($request);
    }

}
