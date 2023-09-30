<?php

use App\Http\Controllers\API\Master\Pengiriman\RajaOngkirController;
use Illuminate\Support\Facades\Route;

Route::prefix("raja_ongkir")->group(function () {
    Route::get("/get_provinsi", [RajaOngkirController::class, "get_provinsi"]);
    Route::get("/get_kota/{province_id}", [RajaOngkirController::class, "get_kota"]);
});
