<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicationController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/nosotros', function () {
    return view('info.nosotros');
});

Route::get('/contacto', function () {
    return view('info.contacto');
});

Route::get('/publications/{publication}/click', [PublicationController::class, 'incrementClicks'])
    ->name('publications.click');

Route::resource('publications', PublicationController::class);
