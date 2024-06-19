<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MtdPembayaranController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Transaksi;
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

Route::get('/', [ClientController::class, 'home'])->name('home');
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
Route::get('/pakets/{product}', [ClientController::class, 'getByProduct']);
Route::get('/paketz/{productid}/{paketId}', [ClientController::class, 'detailProduct'])->name('detail');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::middleware(['can:admin'])->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::put('/change-profile-avatar', [DashboardController::class, 'changeAvatar'])->name('change-profile-avatar');
        Route::delete('/remove-profile-avatar', [DashboardController::class, 'removeAvatar'])->name('remove-profile-avatar');

        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('paket', PaketController::class);
        Route::resource('metode-pembayaran', MtdPembayaranController::class);
        Route::resource('transaksi', TransaksiController::class);
        Route::post('transaksi', [TransaksiController::class,'store'])->name('transaksi.store');
    });

    Route::middleware(['can:user'])->group(function () {
        Route::post('/updateBukti/{id}', [ClientController::class, 'updateBukti'])->name('updateBukti');
        Route::post('/transaksi/{productid}/{paketId}', [ClientController::class, 'transaksi'])->name('transaksi');
        Route::get('/profiles', [ClientController::class, 'profiles'])->name('profiles');
    });
    Route::post('/logout', [ClientController::class, 'logout'])->name('logout');

});
