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
        Schema::create('resep_obat_detail', function (Blueprint $table) {
            $table->string("id_resep_obat_detail", 50)->primary();
            $table->string("id_resep_obat", 50);
            $table->integer("produk_id");
            $table->integer("jumlah");
            $table->double("jumlah_harga");
            $table->enum("status", [1, 0, 2])->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('resep_obat_detail');
    }
};
