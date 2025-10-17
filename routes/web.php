<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EfemerideController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/nosotros', function () {
    return view('info.nosotros');
});

Route::get('/contacto', function () {
    return view('info.contacto');
});

Route::get('/publications/{publication}/click', [PublicationController::class, 'incrementClicks'])
    ->name('publications.click');

Route::resource('publications', PublicationController::class);
Route::resource('reviews', ReviewController::class);
ROute::resource('books', BookController::class);
Route::resource('efemerides', EfemerideController::class);


require __DIR__.'/auth.php';
