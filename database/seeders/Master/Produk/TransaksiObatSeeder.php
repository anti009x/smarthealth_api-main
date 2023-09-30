<?php

namespace Database\Seeders\Master\Produk;

use App\Models\Master\Obat\TransaksiObat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransaksiObat::create([
            "id_transaksi_obat" => "TR-O-2003061",
            "kode_produk" => "PRO-2003061",
            "tanggal" => "2023-05-27",
            "qty" => 10,
            "apotek_id" => "PR-A-12345678910",
            "nama_supplier" => "Mohammad Ilham",
            "asal_supplier" => "Cirebon",
            "status" => 1
        ]);

        TransaksiObat::create([
            "id_transaksi_obat" => "TR-O-2003062",
            "kode_produk" => "PRO-2003062",
            "tanggal" => "2023-05-27",
            "qty" => 20,
            "apotek_id" => "PR-A-12345678910",
            "nama_supplier" => "Mohammad Ilham Teguhriyadi",
            "asal_supplier" => "Cirebon",
            "status" => 1
        ]);

        TransaksiObat::create([
            "id_transaksi_obat" => "TR-O-2003063",
            "kode_produk" => "PRO-2003063",
            "tanggal" => "2023-05-27",
            "qty" => 30,
            "apotek_id" => "PR-A-12345678910",
            "nama_supplier" => "Mohammad Ilham",
            "asal_supplier" => "Cirebon",
            "status" => 1
        ]);

        TransaksiObat::create([
            "id_transaksi_obat" => "TR-O-2003064",
            "kode_produk" => "PRO-2003064",
            "tanggal" => "2023-05-27",
            "qty" => 50,
            "apotek_id" => "PR-A-12345678910",
            "nama_supplier" => "Mohammad Ilham",
            "asal_supplier" => "Cirebon",
            "status" => 1
        ]);

        TransaksiObat::create([
            "id_transaksi_obat" => "TR-O-2003065",
            "kode_produk" => "PRO-2003065",
            "tanggal" => "2023-05-27",
            "qty" => 50,
            "apotek_id" => "PR-A-12345678911",
            "nama_supplier" => "Mohammad Ilham",
            "asal_supplier" => "Cirebon",
            "status" => 1
        ]);

        TransaksiObat::create([
            "id_transaksi_obat" => "TR-O-2003066",
            "kode_produk" => "PRO-2003066",
            "tanggal" => "2023-05-27",
            "qty" => 50,
            "apotek_id" => "PR-A-12345678911",
            "nama_supplier" => "Mohammad Ilham",
            "asal_supplier" => "Cirebon",
            "status" => 1
        ]);
    }
}
