<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExchangeRatesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

        Route::get('/exchangeRates', [ExchangeRatesController::class, 'view'])->name('exchangeRates.view');
        Route::post('/exchangeRates', [ExchangeRatesController::class, 'update'])->name('exchangeRates.update');
    });
});

require __DIR__.'/auth.php';
