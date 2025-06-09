<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\CryptoDepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MarketDataController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TradingController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.index');
})->name('landing.index');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $transactions = App\Models\Transaction::where('user_id', auth()->id())->latest()->take(4)->get();
        return view('dashboard', ['transactions' => $transactions]);
    })->name('dashboard');

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

    Route::get('/trading', [TradingController::class, 'index'])->name('trading');
    Route::post('/trade', [TradingController::class, 'placeTrade'])->name('trade');

    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');

    Route::get('/history', [TransactionController::class, 'index'])->name('history');
    Route::get('/history/export', [TransactionController::class, 'export'])->name('history.export');

    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('/api/prices', [MarketDataController::class, 'getPrices'])->name('api.prices');
});

Route::post('/webhook/blockchair', [CryptoDepositController::class, 'handleWebhook'])->name('webhook.blockchair');

require __DIR__.'/auth.php';