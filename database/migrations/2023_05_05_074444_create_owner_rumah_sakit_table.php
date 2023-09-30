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
        Schema::create('owner_rumah_sakit', function (Blueprint $table) {
            $table->string("id_owner_rumah_sakit", 50)->primary();
            $table->string("no_ktp", 50);
            $table->integer("user_id");
            $table->string("file_dokumen")->nullable();
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
        Schema::dropIfExists('owner_rumah_sakit');
    }
};
