<?php

use Illuminate\Support\Facades\Route;
use Softbengalltd\Larainitializer\Http\Controllers\LarainitializerController;

Route::middleware(['guest','web'])->group(function(){
    Route::get('/setup/{step}', [LarainitializerController::class, 'create'])->name('squartup.setup.form');
    Route::post('/setup/submit',[LarainitializerController::class,'store'])->name('squartup.setup.submit');
});
