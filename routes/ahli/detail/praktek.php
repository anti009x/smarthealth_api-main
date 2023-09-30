<?php

use App\Http\Controllers\API\Master\Ahli\DetailPraktekController;
use Illuminate\Support\Facades\Route;

Route::prefix("ahli")->group(function() {
    Route::prefix("detail_praktek")->group(function() {
        Route::get("/{id_rumah_sakit}", [DetailPraktekController::class, "index"]);
        Route::post("/{id_rumah_sakit}", [DetailPraktekController::class, "store"]);
        Route::get("/{id_detail_praktek}", [DetailPraktekController::class, "edit"]);
        Route::delete("/{id_detail_praktek}", [DetailPraktekController::class, "destroy"]);
    });
});