<?php

use App\Http\Controllers\ContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/contacts/{contact}', [ContactsController::class, 'show']);
    Route::post('/contacts', [ContactsController::class, 'store']);
    Route::patch('/contacts/{contact}', [ContactsController::class, 'update']);
    Route::delete('/contacts/{contact}', [ContactsController::class, 'destroy']);
});
