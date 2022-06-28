<?php

use App\Http\Controllers\cms\DetailKegiatanController;
use App\Http\Controllers\cms\KegiatanController;
use App\Http\Controllers\cms\PegawaiController;
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
Route::prefix('detail_kegiatan')->group(function () {
    Route::get('/', [DetailKegiatanController::class, 'getAllDetail'])->name('detail.all');
    Route::post('/', [DetailKegiatanController::class, 'createDetail']);
    Route::get('/{id}', [DetailKegiatanController::class, 'getDetailById']);
    Route::patch('/{id}', [DetailKegiatanController::class, 'updateDetail']);
    Route::delete('/{id}', [DetailKegiatanController::class, 'deleteDetail']);
});
Route::prefix('kegiatan')->group(function () {
    Route::get('/', [KegiatanController::class, 'getAllKegiatan'])->name('kegiatan.all');
    Route::post('/', [KegiatanController::class, 'createKegiatan']);
    Route::get('/{id}', [KegiatanController::class, 'getKegiatanById']);
    Route::patch('/{id}', [KegiatanController::class, 'updateKegiatan']);
    Route::delete('/{id}', [KegiatanController::class, 'deleteKegiatan']);
});
