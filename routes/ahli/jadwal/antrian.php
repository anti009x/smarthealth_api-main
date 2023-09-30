<?php

use App\Http\Controllers\API\Master\Ahli\JadwalAntrianController;
use Illuminate\Support\Facades\Route;

Route::prefix("ahli")->group(function() {
    Route::get("/jadwal_antrian/all", [JadwalAntrianController::class, "all"]);
    Route::resource("/jadwal_antrian", JadwalAntrianController::class);
});