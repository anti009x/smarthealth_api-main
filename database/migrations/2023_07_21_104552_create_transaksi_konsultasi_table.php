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
        Schema::create('transaksi_konsultasi', function (Blueprint $table) {
            $table->string("id_transaksi_konsultasi", 50)->primary();
            $table->string("konsumen_id", 50);
            $table->string("nama", 50);
            $table->string("nomor_hp", 30);
            $table->string("ahli_id", 50);
            $table->string("nama_ahli", 50);
            $table->string("nomor_hp_ahli", 30);
            $table->double("biaya_konsultasi");
            $table->string("pembayaran", 50)->default();
            $table->enum("status", [1, 0])->default(0);
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
        Schema::dropIfExists('transaksi_konsultasi');
    }
};
