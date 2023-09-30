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
        Schema::create('jadwal_antrian', function (Blueprint $table) {
            $table->string("id_jadwal_antrian", 50)->primary();
            $table->string("konsumen_id", 50);
            $table->string("id_jadwal_praktek", 50);
            $table->enum("status", ["1", "0"]);
            $table->date("tanggal");
            $table->text("qr_code")->nullable();
            $table->string("alasan")->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_antrian');
    }
};
