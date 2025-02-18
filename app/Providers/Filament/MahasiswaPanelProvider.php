<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use App\Models\User;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Auth;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use App\Filament\Mahasiswa\Pages\EditProfile;
use App\Filament\Mahasiswa\Pages\JadwalHasil;
use App\Filament\Mahasiswa\Pages\StatusHasil;
use App\Filament\Mahasiswa\Pages\StatusUjian;
use Illuminate\Session\Middleware\StartSession;
use App\Filament\Mahasiswa\Pages\JadwalProposal;
use App\Filament\Mahasiswa\Pages\StatusProposal;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Middleware\RedirectToProperPanelMiddleware;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use App\Filament\Mahasiswa\Resources\PengajuanJudulResource;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class MahasiswaPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('mahasiswa')
            ->path('mahasiswa')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Mahasiswa/Resources'), for: 'App\\Filament\\Mahasiswa\\Resources')
            ->discoverPages(in: app_path('Filament/Mahasiswa/Pages'), for: 'App\\Filament\\Mahasiswa\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Mahasiswa/Widgets'), for: 'App\\Filament\\Mahasiswa\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->userMenuItems([ 
                'profile' => MenuItem::make()->url(fn (): string => EditProfile::getUrl())
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->items([
                    NavigationItem::make('Dashboard')
                        ->icon('heroicon-o-home')
                        ->isActiveWhen(fn (): bool => request()->routeIs('filament.mahasiswa.pages.dashboard'))
                        ->url(fn (): string => Dashboard::getUrl()),
                ])->groups([
                    NavigationGroup::make('Manajemen Judul')
                    ->items([
                        NavigationItem::make('Pengajuan Judul')
                            ->icon('heroicon-o-clipboard-document-list')
                            ->url(PengajuanJudulResource::getUrl())
                            ->visible(fn(): bool => Auth::user()?->mahasiswaDetail?->sks != null)
                            ->isActiveWhen(fn (): bool => request()->routeIs(PengajuanJudulResource::getRouteBaseName() . '.*')),
                    ]),
                    NavigationGroup::make('Bimbingan')
                    ->items([
                        NavigationItem::make('Bimbingan')
                            ->icon('heroicon-o-chat-bubble-bottom-center-text')
                            ->url('/chatify')
                            ->openUrlInNewTab()
                            ->visible(fn(): bool => User::where('id', Auth::user()->id)->whereHas('pengajuanJudul', function ($query) {
                                $query->where('status', 'diterima');
                            })->count()),

                    ]),
                    NavigationGroup::make('Status Bimbingan')
                    ->items([
                        NavigationItem::make('Status Bimbingan Proposal')
                            ->icon('heroicon-o-presentation-chart-bar')
                            ->url(StatusProposal::getUrl())
                            ->visible(fn(): bool => User::where('id', Auth::user()->id)->whereHas('pengajuanJudul', function ($query) {
                                $query->where('status', 'diterima');
                            })->count())
                            ->isActiveWhen(fn (): bool => request()->routeIs(StatusProposal::getRouteName())),
                        NavigationItem::make('Status Bimbingan Hasil')
                            ->icon('heroicon-o-presentation-chart-line')
                            ->url(StatusHasil::getUrl())
                            ->visible(fn(): bool => User::where('id', Auth::user()->id)->whereHas('bimbinganProposal', function($query) {
                                $query->where('status_dospem1', 'diterima')->where('status_dospem2', 'diterima');
                            })->count())
                            ->isActiveWhen(fn (): bool => request()->routeIs(StatusHasil::getRouteName())),
                        NavigationItem::make('Status Bimbingan Skripsi')
                            ->icon('heroicon-o-bookmark-square')
                            ->url(StatusUjian::getUrl())
                            ->visible(fn(): bool => User::where('id', Auth::user()->id)->whereHas('bimbinganHasil', function($query) {
                                $query->where('status_dospem1', 'diterima')->where('status_dospem2', 'diterima');
                            })->count())
                            ->isActiveWhen(fn (): bool => request()->routeIs(StatusUjian::getRouteName())),
                    ]),
                    NavigationGroup::make('Jadwal')
                    ->items([
                        NavigationItem::make('Jadwal Proposal')
                            ->icon('heroicon-o-document-text')
                            ->url(JadwalProposal::getUrl())
                            ->visible(fn(): bool => User::where('id', Auth::user()->id)->whereHas('seminar', function($query) {
                                $query->where('jenis_seminar', 'proposal');
                            })->count())
                            ->isActiveWhen(fn (): bool => request()->routeIs(JadwalProposal::getRouteName())),
                        NavigationItem::make('Jadwal Hasil')
                            ->icon('heroicon-o-document-text')
                            ->url(JadwalHasil::getUrl())
                            ->visible(fn(): bool => User::where('id', Auth::user()->id)->whereHas('seminar', function($query) {
                                $query->where('jenis_seminar', 'hasil');
                            })->count())
                            ->isActiveWhen(fn (): bool => request()->routeIs(JadwalHasil::getRouteName())),
                    ]),
                ]);
            })
            ->spa()
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                RedirectToProperPanelMiddleware::class, 
                Authenticate::class,
            ]);
    }
}
