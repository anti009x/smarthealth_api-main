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
        Schema::create('rumah_sakit', function (Blueprint $table) {
            $table->string("id_rumah_sakit")->primary();
            $table->string("id_owner_rumah_sakit", 50);
            $table->string("nama_rs", 100);
            $table->string("slug_rs");
            $table->text("deskripsi_rs");
            $table->enum("kategori_rs", [1, 0]);
            $table->string("alamat_rs");
            $table->string("latitude", 100)->nullable();
            $table->string("longitude", 100)->nullable();
            $table->string("foto_rs")->nullable();
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
        Schema::dropIfExists('rumah_sakit');
    }
};
