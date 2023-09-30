<?php

use App\Http\Controllers\API\Transaksi\RiwayatTransaksiProdukController;
use Illuminate\Support\Facades\Route;

Route::prefix("transaksi")->group(function() {
    Route::resource("produk", RiwayatTransaksiProdukController::class);
});