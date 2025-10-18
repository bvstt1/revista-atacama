<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ProfileController,
    PublicationController,
    ReviewController,
    BookController,
    EfemerideController,
    EditionController   
};
use App\Models\Publication;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/books/panel', [BookController::class, 'panel'])->name('books.panel');
    Route::get('/publications/panel', [PublicationController::class, 'panel'])->name('publications.panel');
    Route::get('/reviews/panel', [ReviewController::class, 'panel'])->name('reviews.panel');
    Route::get('/efemerides/panel', [EfemerideController::class, 'panel'])->name('efemerides.panel');
    
    Route::resource('publications', PublicationController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('books', BookController::class);
    Route::resource('efemerides', EfemerideController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/featured', [PublicationController::class, 'featured']);

Route::get('/articulos', [PublicationController::class, 'indexPublic'])->name('publications.public_index');

Route::get('/editions', [EditionController::class, 'index'])->name('editions.index');
Route::get('/editions/{edition}', [EditionController::class, 'show'])->name('editions.show');

Route::view('/nosotros', 'info.nosotros')->name('nosotros');
Route::view('/contacto', 'info.contacto')->name('contacto');

//Contador de clics en publicaciones (no restringido)
Route::get('/publications/{publication}/click', [PublicationController::class, 'incrementClicks'])
    ->name('publications.click');

require __DIR__.'/auth.php';
