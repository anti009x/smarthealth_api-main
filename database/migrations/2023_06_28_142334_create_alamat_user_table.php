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
        Schema::create('alamat_user', function (Blueprint $table) {
            $table->string("id_alamat_user", 50)->primary();
            $table->integer("user_id");
            $table->string("simpan_sebagai", 100);
            $table->string("lokasi", 100);
            $table->text("detail");
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
        Schema::dropIfExists('alamat_user');
    }
};
