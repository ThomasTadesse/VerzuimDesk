<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerzuimController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/verzuim/import', [VerzuimController::class, 'import'])->name('verzuim.import');

