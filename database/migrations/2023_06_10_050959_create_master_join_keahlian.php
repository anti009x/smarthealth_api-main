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
        Schema::create('master_join_keahlian', function (Blueprint $table) {
            $table->string("id_master_join_keahlian", 50)->primary();
            $table->integer("user_ahli_id");
            $table->string("keahlian_id", 50);
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
        Schema::dropIfExists('master_join_keahlian');
    }
};
