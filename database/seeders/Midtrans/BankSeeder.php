<?php

namespace Database\Seeders\Midtrans;

use App\Models\Midtrans\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
            "id_bank" => "BNK-2003061",
            "nama_bank" => "BNI",
            "slug_bank" => Str::slug("BNI")
        ]);

        Bank::create([
            "id_bank" => "BNK-2003062",
            "nama_bank" => "BCA",
            "slug_bank" => Str::slug("BCA")
        ]);

        Bank::create([
            "id_bank" => "BNK-2003063",
            "nama_bank" => "BRI",
            "slug_bank" => Str::slug("BRI")
        ]);

        Bank::create([
            "id_bank" => "BNK-2003064",
            "nama_bank" => "PERMATA",
            "slug_bank" => Str::slug("PERMATA")
        ]);
    }
}
