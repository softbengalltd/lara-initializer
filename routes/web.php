<?php

use Illuminate\Support\Facades\Route;
use EngrShishir\Contactform\Http\Controllers\ContactFormController;

Route::middleware(['guest','web'])->group(function(){
    Route::get('/setup/{step}', [ContactFormController::class, 'create'])->name('squartup.setup.form');
    Route::post('/setup/submit',[ContactFormController::class,'store'])->name('squartup.setup.submit');
});
