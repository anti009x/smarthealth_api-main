<?php

namespace Database\Seeders\Master\Ahli;

use App\Models\Ahli\PraktekAhli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PraktekAhliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PraktekAhli::create([
            "id_praktek_ahli" => ""
        ]);
    }
}
