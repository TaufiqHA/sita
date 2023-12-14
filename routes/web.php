<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login
Route::delete('logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('/login', LoginController::class)->names([
    'index' => 'login',
]);

// Register
Route::get('/authGoogle', [RegisterController::class, 'authGoogle'])->name('googleAuth');

Route::resource('/register', RegisterController::class)->names([
    'index' => 'register.form',
    'store' => 'register',
]);

// Dashboard
Route::get('/dosen', [DashboardController::class, 'dashboardDosen'])->middleware('isDosen')->name('dosen');

Route::get('/admin', [DashboardController::class, 'dashboardAdmin'])->middleware('isAdmin')->name('admin');

Route::resource('dashboard', DashboardController::class)->middleware([
    'index' => 'isLogin'
])->names([
    'index' => 'dashboard'
]);
