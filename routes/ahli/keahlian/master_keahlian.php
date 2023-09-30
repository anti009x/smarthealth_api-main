<?php

use App\Http\Controllers\API\Master\Ahli\MasterJoinKeahlianController;
use Illuminate\Support\Facades\Route;

Route::prefix("ahli")->group(function() {
    Route::prefix("keahlian")->group(function() {
        Route::get("/master/{id_user}/get", [MasterJoinKeahlianController::class, "list_master"]);
        Route::resource("master", MasterJoinKeahlianController::class);
    });
});
