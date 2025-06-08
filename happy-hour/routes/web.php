<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\CryptoDepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MarketDataController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/deposit/fiat', [DepositController::class, 'showFiatDepositForm'])->name('deposit.fiat.form');
    Route::post('/deposit/fiat', [DepositController::class, 'processFiatDeposit'])->name('deposit.fiat');
    Route::get('/deposit/fiat/success', [DepositController::class, 'successFiatDeposit'])->name('deposit.fiat.success');
    Route::get('/deposit/fiat/cancel', [DepositController::class, 'cancelFiatDeposit'])->name('deposit.fiat.cancel');
    Route::get('/deposit/crypto', [CryptoDepositController::class, 'showCryptoDepositForm'])->name('deposit.crypto.form');
    Route::post('/deposit/crypto', [CryptoDepositController::class, 'generateCryptoAddress'])->name('deposit.crypto');
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
    Route::get('/api/prices', [MarketDataController::class, 'getPrices'])->name('api.prices');
});

Route::post('/webhook/blockchair', [CryptoDepositController::class, 'handleWebhook'])->name('webhook.blockchair');

require __DIR__.'/auth.php';