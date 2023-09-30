<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->string("id_pembelian", 50)->primary();
            $table->string("konsumen_id", 50);
            $table->string("ongkir_id", 50)->nullable();
            $table->datetime("tanggal_pembelian");
            $table->double("total_pembelian");
            $table->string("nama_kota")->nullable();
            $table->double("tarif")->double();
            $table->text("alamat_pengiriman");
            $table->enum("status_pembelian", ["PENDING", "SUDAH PEMBAYARAN", "BARANG DIKIRIM", "SELESAI"]);
            $table->string("resi_pengiriman", 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian');
    }
};
