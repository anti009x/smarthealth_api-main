<?php

namespace Database\Seeders;

use App\Models\Transaksi\ResepObat;
use App\Models\Transaksi\ResepObatDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlottingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ResepObat::create([
            "id_resep_obat" => "TRN-RO-2003061",
            "ahli_id" => 6,
            "konsumen_id" => 22,
            "tanggal" => "2023-09-08 08:45:00",
            "jumlah_harga" => 80000
        ]);

        ResepObatDetail::create([
            "id_resep_obat_detail" => "TRN-RO-D-2003061",
            "id_resep_obat" => "TRN-RO-2003061",
            "produk_id" => 1,
            "jumlah" => 1,
            "jumlah_harga" => 50000
        ]);

        ResepObatDetail::create([
            "id_resep_obat_detail" => "TRN-RO-D-2003062",
            "id_resep_obat" => "TRN-RO-2003061",
            "produk_id" => 2,
            "jumlah" => 1,
            "jumlah_harga" => 30000
        ]);
    }
}
