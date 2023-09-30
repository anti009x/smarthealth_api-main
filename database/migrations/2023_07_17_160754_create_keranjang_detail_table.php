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
        Schema::create('keranjang_detail', function (Blueprint $table) {
            $table->string("id_keranjang_detail", 50)->primary();
            $table->string("produk_id", 50);
            $table->string("keranjang_id", 50);
            $table->integer("jumlah");
            $table->integer("jumlah_harga");
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
        Schema::dropIfExists('keranjang_detail');
    }
};
