<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Example API route for ASP.NET synchronization
// To secure it, wrap it inside a Route::middleware('auth:sanctum')->group(...) block
Route::match(['get', 'post'], '/rest-api/v1/{module}/{action}', [\App\Http\Controllers\Api\SyncController::class, 'handleRequest']);
