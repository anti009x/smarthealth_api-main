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
        Schema::create('fasilitas_rumah_sakit', function (Blueprint $table) {
            $table->string("id_fasilitas", 50)->primary();
            $table->string("id_rumah_sakit", 50);
            $table->string("nama_fasilitas", 50);
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
        Schema::dropIfExists('fasilitas_rumah_sakit');
    }
};
