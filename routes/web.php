<?php

use App\Http\Controllers\cms\DetailKegiatanController;
use App\Http\Controllers\cms\KegiatanController;
use App\Http\Controllers\cms\PegawaiController;
use App\Http\Controllers\google_service\SetEventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('page.Example');
});

Route::prefix('pegawai')->group(function () {
    Route::get('/', [PegawaiController::class, 'getAllPegawai'])->name('pegawai.all');
    Route::post('/', [PegawaiController::class, 'createPegawai']);
    Route::get('/{id}', [PegawaiController::class, 'getPegawaiById']);
    Route::patch('/{id}', [PegawaiController::class, 'updatePegawai']);
    Route::delete('/{id}', [PegawaiController::class, 'deletePegawai']);
});
Route::prefix('kegiatan')->group(function () {
    Route::get('/', [KegiatanController::class, 'getAllKegiatan'])->name('kegiatan.all');
    Route::post('/', [KegiatanController::class, 'createKegiatan']);
    Route::get('/{id}', [KegiatanController::class, 'getKegiatanById']);
    Route::patch('/{id}', [KegiatanController::class, 'updateKegiatan']);
    Route::delete('/{id}/{id_detail}', [KegiatanController::class, 'deleteKegiatan']);
});

Route::prefix('kalender')->group(function () {
    Route::get('/', [SetEventController::class, 'index'])->name('kalender.all');
});
