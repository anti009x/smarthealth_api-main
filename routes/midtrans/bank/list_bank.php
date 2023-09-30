<?php

use App\Http\Controllers\Midtrans\BankController;
use Illuminate\Support\Facades\Route;

Route::prefix("midtrans")->group(function() {
    Route::get("/bank", [BankController::class, "list_bank"]);
});