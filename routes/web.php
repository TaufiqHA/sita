<?php

use App\Filament\Pages\ListJudulMahasiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:web'])->group(function () {
    route::get('/judul/list/{record}', ListJudulMahasiswa::class)->name('judul.list');
});