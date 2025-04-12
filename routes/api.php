<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\RequestController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/forms', [FormController::class, 'index']);
Route::post('/form', [FormController::class, 'show']);
Route::post('/request', [RequestController::class, 'store']);
Route::fallback(function () {
    return response()->json(['message' => 'Route tidak ditemukan'], 404);
});
