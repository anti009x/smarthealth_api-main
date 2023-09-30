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
        Schema::create('transaksi_buat_janji', function (Blueprint $table) {
            $table->string("id_transaksi_buat_janji", 50)->primary();
            $table->string("konsumen_id", 50);
            $table->string("nama", 100);
            $table->string("nomor_hp", 30);
            $table->integer("ahli_id");
            $table->string("nama_ahli", 100);
            $table->string("nomor_hp_ahli", 30);
            $table->string("foto_ahli")->nullable();
            $table->double("biaya_praktek");
            $table->string("nama_rs", 100);
            $table->date("tanggal_transaksi");
            $table->tinyInteger("status");
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
        Schema::dropIfExists('transaksi_buat_janji');
    }
};
