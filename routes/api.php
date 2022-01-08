<?php

use App\Http\Controllers\ContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/contacts', [ContactsController::class, 'index']);
    Route::post('/contacts', [ContactsController::class, 'store']);
    Route::get('/contacts/{contact}', [ContactsController::class, 'show']);
    Route::patch('/contacts/{contact}', [ContactsController::class, 'update']);
    Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy']);
});