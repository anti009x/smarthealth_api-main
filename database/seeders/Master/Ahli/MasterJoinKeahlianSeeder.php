<?php

namespace Database\Seeders\Master\Ahli;

use App\Models\Ahli\MasterJoinKeahlian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterJoinKeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterJoinKeahlian::create([
            "id_master_join_keahlian" => "MSTR-J-2003061",
            "user_ahli_id" => 2,
            "keahlian_id" => "KHLI-2001" 
        ]);

        MasterJoinKeahlian::create([
            "id_master_join_keahlian" => "MSTR-J-2003062",
            "user_ahli_id" => 2,
            "keahlian_id" => "KHLI-2002" 
        ]);

        MasterJoinKeahlian::create([
            "id_master_join_keahlian" => "MSTR-J-2003063",
            "user_ahli_id" => 6,
            "keahlian_id" => "KHLI-2001" 
        ]);

        MasterJoinKeahlian::create([
            "id_master_join_keahlian" => "MSTR-J-2003064",
            "user_ahli_id" => 10,
            "keahlian_id" => "KHLI-2001" 
        ]);

        MasterJoinKeahlian::create([
            "id_master_join_keahlian" => "MSTR-J-2003065",
            "user_ahli_id" => 16,
            "keahlian_id" => "KHLI-2001" 
        ]);

        MasterJoinKeahlian::create([
            "id_master_join_keahlian" => "MSTR-J-2003066",
            "user_ahli_id" => 17,
            "keahlian_id" => "KHLI-2001" 
        ]);

        MasterJoinKeahlian::create([
            "id_master_join_keahlian" => "MSTR-J-2003067",
            "user_ahli_id" => 14,
            "keahlian_id" => "KHLI-2001" 
        ]);
        
        MasterJoinKeahlian::create([
            "id_master_join_keahlian" => "MSTR-J-2003068",
            "user_ahli_id" => 15,
            "keahlian_id" => "KHLI-2001" 
        ]);
    }
}
