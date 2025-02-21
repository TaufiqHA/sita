<?php

use App\Http\Controllers\SpreadSheetController;
use App\Mail\NotifikasiJudul;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/export', [SpreadSheetController::class, 'export']);