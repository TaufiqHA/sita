<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JudulController;
use App\Http\Controllers\UserController;

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
])->middleware([
    'index' => 'isGuest'
]);

// Register
Route::get('/authGoogle', [RegisterController::class, 'authGoogle'])->name('googleAuth');

Route::resource('/register', RegisterController::class)->names([
    'index' => 'register.form',
    'store' => 'register',
])->middleware([
    'index' => 'isGuest'
]);

// Dashboard
Route::get('/dosen', [DashboardController::class, 'dashboardDosen'])->middleware('isDosen')->name('dosen');

Route::get('/admin', [DashboardController::class, 'dashboardAdmin'])->middleware('isAdmin')->name('admin');

Route::resource('dashboard', DashboardController::class)->middleware([
    'index' => 'isLogin'
])->names([
    'index' => 'dashboard'
]);

// Mahasiswa
Route::resource('mahasiswa', MahasiswaController::class)->names([
    'index' => 'mahasiswa',
    'show' => 'data.mahasiswa'
])->middleware([
    'index' => 'isLogin',
    'show' => 'isLogin',
    'update' => 'isLogin'
]);

// Dosen
Route::resource('pegawai', PegawaiController::class);

// Judul
Route::resource('judul', JudulController::class)->middleware('isLogin');

// User
Route::put('user/edit', [UserController::class, 'userEdit'])->name('userEdit')->middleware('isLogin');
Route::resource('user', UserController::class)->names([
    'show' => 'edit.user',
])->middleware('isLogin');
