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
        Schema::create('jadwal_praktek', function (Blueprint $table) {
            $table->string("id_jadwal_praktek", 50)->primary();
            $table->string("id_detail_praktek", 50);
            $table->string("hari", 30)->nullable();
            $table->date("tanggal")->nullable();
            $table->time("mulai_jam")->nullable();
            $table->time("selesai_jam")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_praktek_dokter');
    }
};
