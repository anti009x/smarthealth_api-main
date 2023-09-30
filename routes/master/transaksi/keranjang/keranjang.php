<?php

use App\Http\Controllers\API\Transaksi\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::prefix("keranjang")->group(function() {
    Route::get("/{id_keranjang}", [KeranjangController::class, "show"]);
    Route::get("/total/by_konsumen", [KeranjangController::class, "total"]);
    Route::resource("", KeranjangController::class);
})->name("keranjang");