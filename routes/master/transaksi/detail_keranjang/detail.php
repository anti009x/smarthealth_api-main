<?php

use App\Http\Controllers\Transaksi\DetailKeranjangController;
use Illuminate\Support\Facades\Route;

Route::prefix("detail_keranjang")->group(function() {
    Route::put("/kurang/{id_detail_keranjang}", [DetailKeranjangController::class, "kurang"]);
    Route::put("/tambah/{id_detail_keranjang}", [DetailKeranjangController::class, "tambah"]);
    Route::delete("/{id_detail_keranjang}", [DetailKeranjangController::class, "destroy"]);
    Route::delete("/all_data/hapus", [DetailKeranjangController::class, "hapus_semua_data"]);
});