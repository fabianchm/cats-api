<?php

use App\Http\Controllers\Pictures\CatPicturesGetController;
use Illuminate\Support\Facades\Route;

Route::name('pictures.')->middleware('auth.bearer')->group(function(){
    Route::get('/cat', CatPicturesGetController::class)->name('cats.get');
});
