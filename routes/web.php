<?php

use App\Exports\UserExport;
use App\Filament\Dosen\Pages\DetailBimbingan;
use App\Filament\Pages\ListJudulMahasiswa;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

// route::get('/download', function () {
//     return Excel::download(new UserExport, 'users.xlsx');
// })->name('download.user');