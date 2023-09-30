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
        Schema::create('praktek_ahli', function (Blueprint $table) {
            $table->string("id_praktek_ahli", 50)->primary();
            $table->string("ahli_id", 50);
            $table->string("id_keahlian", 50)->nullable();
            $table->string("id_spesialis", 50)->nullable();
            $table->string("id_rumah_sakit", 50);
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
        Schema::dropIfExists('praktek_ahli');
    }
};
