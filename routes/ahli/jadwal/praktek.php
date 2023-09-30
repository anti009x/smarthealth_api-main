<?php

use App\Http\Controllers\API\Master\Ahli\JadwalPraktekController;
use Illuminate\Support\Facades\Route;

Route::prefix("ahli")->group(function() {
    Route::prefix("jadwal_praktek")->group(function() {
        Route::get("/{ahli_id}/{id_rumah_sakit}", [JadwalPraktekController::class, "index"]);
        Route::post("/{id_detail_praktek}", [JadwalPraktekController::class, "store"]);
        Route::get("/jadwal/{id_jadwal_praktek}/edit", [JadwalPraktekController::class, "edit"]);
        Route::put("/{id_jadwal_praktek}", [JadwalPraktekController::class, "update"]);
        Route::delete("/{id_jadwal_praktek}", [JadwalPraktekController::class, "destroy"]);
    });
});