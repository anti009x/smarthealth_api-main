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
        Schema::create('transaksi_obat', function (Blueprint $table) {
            $table->string("id_transaksi_obat", 50)->primary();
            $table->string("kode_produk", 50);
            $table->date("tanggal");
            $table->integer("qty");
            $table->string("apotek_id", 50);
            $table->string("nama_supplier", 50)->nullable();
            $table->string("asal_supplier", 100)->nullable();
            $table->tinyInteger("status")->default(1);
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
        Schema::dropIfExists('transaksi_obat');
    }
};
