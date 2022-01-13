<?php

Auth::routes();

Route::get('/{any}', [App\Http\Controllers\AppController::class, 'index'])->where('any', '.*');