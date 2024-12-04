<?php

use App\Filament\Dosen\Pages\DetailBimbingan;
use App\Filament\Pages\ListJudulMahasiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});