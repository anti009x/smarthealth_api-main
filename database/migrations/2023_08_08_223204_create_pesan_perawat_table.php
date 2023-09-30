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
        Schema::create('pesan_perawat', function (Blueprint $table) {
            $table->string("id_pesan_perawat", 50)->primary();
            $table->string("konsumen_id", 50);
            $table->string("ahli_id");
            $table->enum("status", [1, 0])->default(0);
            $table->text("alamat")->nullable();
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
        Schema::dropIfExists('pesan_perawat');
    }
};
