<?php

use App\Http\Controllers\BirthdayController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/contacts', [ContactsController::class, 'index']);
    Route::post('/contacts', [ContactsController::class, 'store']);
    Route::get('/contacts/{contact}', [ContactsController::class, 'show']);
    Route::patch('/contacts/{contact}', [ContactsController::class, 'update']);
    Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy']);

    Route::get('birthdays', [BirthdayController::class, 'index']);
    Route::post('search', [SearchController::class, 'index']);
});