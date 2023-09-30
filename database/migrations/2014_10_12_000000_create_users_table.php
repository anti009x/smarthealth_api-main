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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("nama", 100);
            $table->string("email", 100)->nullable()->unique();
            $table->string("password");
            $table->string("nomor_hp", 20);
            $table->text("alamat")->nullable();
            $table->string("id_role", 50);
            $table->integer("created_by")->nullable();
            $table->enum("jenis_kelamin", ["L", "P"])->nullable();
            $table->string("token")->nullable();
            $table->string("foto")->nullable();
            $table->integer("usia")->nullable();
            $table->double("berat_badan")->nullable();
            $table->double("tinggi_badan")->nullable();
            $table->string("tempat_lahir", 50)->nullable();
            $table->date("tanggal_lahir")->nullable();
            $table->enum("status", [1, 0]);
            $table->string("uuid_firebase", 100)->nullable();
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
        Schema::dropIfExists('users');
    }
};
