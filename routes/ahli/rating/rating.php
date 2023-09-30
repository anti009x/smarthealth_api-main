<?php

use App\Http\Controllers\Master\Ahli\RatingController;
use Illuminate\Support\Facades\Route;

Route::prefix("ahli")->group(function() {
    Route::resource("rating", RatingController::class);
});