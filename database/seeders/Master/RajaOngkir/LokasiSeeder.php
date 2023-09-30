<?php

namespace Database\Seeders\Master\RajaOngkir;

use App\Models\Master\RajaOngkir\Kota;
use App\Models\Master\RajaOngkir\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daftarProvinsi = RajaOngkir::provinsi()->all();
        foreach ($daftarProvinsi as $provinsi) {
            Provinsi::create([
                "province_id" => $provinsi["province_id"],
                "title" => $provinsi["province"]
            ]);

            $daftarKota = RajaOngkir::kota()->dariProvinsi($provinsi["province_id"])->get();
            foreach ($daftarKota as $city) {
                Kota::create([
                    "province_id" => $provinsi["province_id"],
                    "city_id" => $city["city_id"],
                    "title" => $city["city_name"]
                ]);
            }
        }
    }
}
