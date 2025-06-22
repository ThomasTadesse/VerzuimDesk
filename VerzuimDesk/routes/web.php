<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerzuimController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/verzuim/import', function () {
    return view('verzuim.import');
})->name('verzuim.import.form');

Route::post('/verzuim/import', [VerzuimController::class, 'import'])->name('verzuim.import');

Route::get('/verzuim/upload', [VerzuimController::class, 'form']);
Route::post('/verzuim/upload', [VerzuimController::class, 'upload'])->name('verzuim.upload');

Route::get('/select-klas', [VerzuimController::class, 'selectForm']);
Route::post('/select-klas', [VerzuimController::class, 'showAverage'])->name('verzuim.klasGemiddelde');

Route::get('/klas/{klas}', [VerzuimController::class, 'toonKlas'])->name('verzuim.klasDetail');
Route::get('/verzuim', [VerzuimController::class, 'index'])->name('verzuim.index');