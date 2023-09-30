<?php

use App\Http\Controllers\API\Master\Ahli\PraktekAhliController;
use Illuminate\Support\Facades\Route;

Route::prefix("ahli")->group(function() {
    Route::prefix("praktek")->group(function() {
        Route::resource("praktek_rs", PraktekAhliController::class);
    });
});