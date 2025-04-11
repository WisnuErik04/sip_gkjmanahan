<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\RequestController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/forms', [FormController::class, 'index']);
Route::get('/forms/{id}', [FormController::class, 'show']);
Route::post('/request', [RequestController::class, 'store']);
