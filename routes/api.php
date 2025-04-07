<?php

use App\Http\Controllers\API\MidtransCallbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('midtrans/callback',[MidtransCallbackController::class,'callback']);