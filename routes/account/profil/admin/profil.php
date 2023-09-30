<?php

use App\Http\Controllers\API\Akun\Profile\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->group(function () {
    Route::get("/profil", [ProfileController::class, "get_profil"]);
    Route::put("/profil", [ProfileController::class, "update_profil"]);
});
