<?php

namespace Database\Seeders\Akun;

use App\Models\Akun\OwnerApotek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerApotekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OwnerApotek::create([
            "id_owner_apotek" => "OWN-312456789",
            "user_id" => 5
        ]);

        OwnerApotek::create([
            "id_owner_apotek" => "OWN-293293289",
            "user_id" => 8
        ]);
    }
}
