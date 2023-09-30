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
        Schema::create('invoice_message', function (Blueprint $table) {
            $table->id();
            $table->string("invoice", 30);
            $table->string("id_jenis_transaksi", 50);
            $table->string("transaction_id");
            $table->enum("status", ["WAITING", "PENDING", "CANCEL", "SUCCESS"]);
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
        Schema::dropIfExists('invoice_message');
    }
};
