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
        Schema::create('produk', function (Blueprint $table) {
            $table->id("id_produk");
            $table->string("kode_produk", 50);
            $table->string("id_owner_apotek", 50);
            $table->string("id_profil_apotek", 50);
            $table->string("nama_produk", 50);
            $table->string("slug_produk");
            $table->text("deskripsi_produk");
            $table->double("harga_produk");
            $table->string("foto_produk")->nullable();
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
        Schema::dropIfExists('produk');
    }
};
