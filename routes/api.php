<?php

use App\Http\Controllers\google_service\SetEventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/setEvent', [SetEventController::class, 'setEvent']);
Route::delete('/deleteEvent/{id}', [SetEventController::class, 'deleteEvent']);
