<?php

use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\KatalogController;
use Illuminate\Support\Facades\Route;

// Halaman Publik
Route::get('/', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/produk/{produk}', [KatalogController::class, 'show'])->name('katalog.show');

// Halaman Admin (CRUD Produk)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('produk', AdminProdukController::class)->except(['show']);
});