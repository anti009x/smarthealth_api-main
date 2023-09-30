<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use App\Http\Resources\Midtrans\GetBankResource;
use App\Models\Midtrans\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function list_bank()
    {
        return DB::transaction(function() {
            $data = Bank::orderBy("nama_bank", "ASC")->get();

            return GetBankResource::collection($data);
        });
    }
}
