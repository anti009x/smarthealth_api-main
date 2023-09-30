<?php

use App\Http\Controllers\API\Master\RumahSakit\FasilitasRumahSakitController;
use Illuminate\Support\Facades\Route;

Route::controller(FasilitasRumahSakitController::class)->group(function () {

    Route::get("/fasilitas_rs/rs/{id_rumah_sakit}", "get_list_fasilitas");
});

Route::resource("fasilitas_rs", FasilitasRumahSakitController::class);
