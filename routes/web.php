<?php

Auth::routes();

Route::get('/logout-mamual', function(){
    request()->session()->invalidate();
});

Route::get('/{any}', [App\Http\Controllers\AppController::class, 'index'])->where('any', '.*');