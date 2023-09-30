<?php

use App\Http\Controllers\API\Akun\Profile\Konsumen\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix("konsumen")->group(function () {
    Route::get("/profil", [ProfileController::class, "get_profil"]);
    Route::put("/profil", [ProfileController::class, "update_profil"]);
    Route::get("/update_saldo", [ProfileController::class, "get_saldo"]);
    Route::put("/update_saldo", [ProfileController::class, "update_saldo"]);
});
