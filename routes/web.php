<?php

Auth::routes();

// Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{any}', [App\Http\Controllers\AppController::class, 'index'])->where('any', '.*');