<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaisonController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\PaiementController;

/*
|--------------------------------------------------------------------------
| Page publique
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| Dashboard Breeze
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile Breeze
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Maisons (public)
|--------------------------------------------------------------------------
*/

Route::get('/maisons', [MaisonController::class, 'index'])->name('maisons.index');

Route::get('/maisons/{maison}', [MaisonController::class, 'show'])->name('maisons.show');

Route::post('/chatbot/message', [ChatbotController::class, 'ask'])->name('chatbot.ask');


/*
|--------------------------------------------------------------------------
| Routes protégées (auth)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Réservations
    |--------------------------------------------------------------------------
    */

    Route::get('/reservations/create/{chambre}', [ReservationController::class, 'create'])
    ->name('reservations.create');

    Route::post('/reservations', [ReservationController::class, 'store'])
        ->name('reservations.store');

    Route::get('/mes-reservations', [ReservationController::class, 'index'])
        ->name('reservations.index');

    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])
        ->name('reservations.destroy');

     

    Route::get('/paiement/{reservation}', [PaiementController::class, 'payer'])
        ->name('paiement.payer');

    Route::post('/paiement/{reservation}', [PaiementController::class, 'confirmer'])
    ->name('paiement.confirmer');



    

    /*
    |--------------------------------------------------------------------------
    | Avis
    |--------------------------------------------------------------------------
    */

    Route::post('/avis', [AvisController::class, 'store'])->name('avis.store');

    Route::delete('/avis/{avis}', [AvisController::class, 'destroy'])->name('avis.destroy');

    Route::post('/favoris/{maison}/toggle', [FavorisController::class, 'toggle'])->name('favoris.toggle')->middleware('auth');

});


/*
|--------------------------------------------------------------------------
| Auth Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';