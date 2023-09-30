<?php

namespace Database\Seeders;

use App\Models\Transaksi\TransaksiKonsultasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RiwayatKonsultasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransaksiKonsultasi::create([
            "id_transaksi_konsultasi" => "TRN-K-2003061",
            "konsumen_id" => "KSN-20230809092047",
            "nama" => "Mohammad",
            "nomor_hp" => "23928329382",
            "ahli_id" => 1,
            "nama_ahli" => "DR. Rizka",
            "nomor_hp_ahli" => "283293823892",
            "biaya_konsultasi" => 20000,
            "pembayaran" => 1,
            "status" => "0" 
        ]);
        
        TransaksiKonsultasi::create([
            "id_transaksi_konsultasi" => "TRN-K-2003062",
            "konsumen_id" => "KSN-20230809092047",
            "nama" => "Mohammad",
            "nomor_hp" => "23928329382",
            "ahli_id" => 1,
            "nama_ahli" => "DR. Mohammad",
            "nomor_hp_ahli" => "283293823893",
            "biaya_konsultasi" => 30000,
            "pembayaran" => 1,
            "status" => "0" 
        ]);
    }
}
