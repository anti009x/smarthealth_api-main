<?php

use App\Http\Controllers\API\Master\RumahSakit\DataRumahSakitController;
use Illuminate\Support\Facades\Route;

Route::controller(DataRumahSakitController::class)->group(function () {
    Route::post("/data/find_nearest/all", "all_find_nearest");
    Route::post("/data/find_nearest", "find_nearest");
    Route::get("/data/{user_id}", "get_rs_by_id");
});

Route::resource("/data", DataRumahSakitController::class);
