<?php

use App\Http\Controllers\API\Transaksi\ResepObatController;
use App\Http\Controllers\API\Transaksi\ResepObatDetailController;
use Illuminate\Support\Facades\Route;

Route::prefix("resep")->group(function() {
    Route::put("/detail_obat/tambah/{id_resep_obat_detail}", [ResepObatDetailController::class, "tambah"]);
    Route::put("/detail_obat/kurang/{id_resep_obat_detail}", [ResepObatDetailController::class, "kurang"]);
    Route::delete("/detail_obat/hapus/{id_konsumen}", [ResepObatDetailController::class, "hapus"]);
    Route::put("/detail_obat/{id_keranjang}", [ResepObatDetailController::class, "resep"]);
    Route::resource("/detail_obat", ResepObatDetailController::class);
    Route::put("/obat/{id_keranjang}/setuju", [ResepObatDetailController::class, "setuju"]);
    Route::resource('obat', ResepObatController::class);
});