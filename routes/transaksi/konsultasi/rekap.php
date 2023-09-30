<?php

use App\Http\Controllers\API\Transaksi\RiwayatKonsultasiController;
use Illuminate\Support\Facades\Route;

Route::prefix("transaksi")->group(function() {
    Route::resource("/konsultasi", RiwayatKonsultasiController::class);
});