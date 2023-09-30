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
        Schema::create('detail_praktek', function (Blueprint $table) {
            $table->string("id_detail_praktek", 50)->primary();
            $table->tinyInteger("ahli_id");
            $table->string("id_rumah_sakit");
            $table->double("biaya_praktek")->nullable();
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
        Schema::dropIfExists('detail_praktek_dokter');
    }
};
