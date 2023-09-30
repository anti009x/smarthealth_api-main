<?php

use App\Http\Controllers\API\Autentikasi\ConfirmEmailController;
use App\Http\Controllers\API\Autentikasi\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix("autentikasi")->group(function () {
    Route::post("/login", [LoginController::class, "login"]);
    Route::get("/login", function () {
        return response()->json([
            "pesan" => "Anda Harus Login Terlebih Dahulu",
            "status" => 401
        ]);
    })->name("login");
    Route::post("/register", [LoginController::class, "register"]);
    Route::post("/confirm_email", [ConfirmEmailController::class, "confirm"]);
    Route::put("/forgot_password/{token}", [ConfirmEmailController::class, "forgot_password"]);
});
