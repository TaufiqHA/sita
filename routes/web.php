<?php

use App\Http\Controllers\PengajuanJudulController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:mahasiswa', 'verified'])->name('dashboard');

Route::middleware('auth:mahasiswa')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('judul', PengajuanJudulController::class)->name('index', 'judul')->middleware('auth:mahasiswa');

require __DIR__.'/auth.php';
