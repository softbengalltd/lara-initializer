<?php

use Illuminate\Support\Facades\Route;
use Softbengal\LaraInitializer\Http\Controllers\LaraSetupFormController;

Route::middleware(['guest','web'])->group(function(){
    Route::get('/setup/{step}', [LaraSetupFormController::class, 'create'])->name('squartup.setup.form');
    Route::post('/setup/submit',[LaraSetupFormController::class,'store'])->name('squartup.setup.submit');
});
