<?php

use App\Http\Controllers\API\Transaksi\TransaksiKonsultasi;
use Illuminate\Support\Facades\Route;

Route::prefix("transaksi")->group(function() {
    Route::resource("konsultasi", TransaksiKonsultasi::class);
});