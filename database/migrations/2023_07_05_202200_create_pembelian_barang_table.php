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
        Schema::create('pembelian_barang', function (Blueprint $table) {
            $table->string("id_pembelian_barang", 50)->primary();
            $table->string("id_pembelian", 50);
            $table->string("kode_produk", 50);
            $table->integer("jumlah");
            $table->string("nama_barang");
            $table->double("harga");
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
        Schema::dropIfExists('pembelian_barang');
    }
};
