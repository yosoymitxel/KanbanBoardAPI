<?php

use App\Http\Controllers\API\BoardsApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('api')->group(function () {
    Route::apiResource('boards', BoardsApiController::class);
});
