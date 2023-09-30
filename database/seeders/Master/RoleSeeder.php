<?php

namespace Database\Seeders\Master;

use App\Models\Master\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "id_role" => "RO-2003061",
            "nama_role" => "Administrator"
        ]);

        Role::create([
            "id_role" => "RO-2003062",
            "nama_role" => "Dokter"
        ]);

        Role::create([
            "id_role" => "RO-2003063",
            "nama_role" => "Perawat"
        ]);

        Role::create([
            "id_role" => "RO-2003064",
            "nama_role" => "Konsumen"
        ]);

        Role::create([
            "id_role" => "RO-2003065",
            "nama_role" => "Owner Apotek"
        ]);

        Role::create([
            "id_role" => "RO-2003066",
            "nama_role" => "Admin Rumah Sakit"
        ]);
        
        Role::create([
            "id_role" => "RO-2003067",
            "nama_role" => "Admin Apotek"
        ]);
    }
}
