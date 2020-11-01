<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kelas');

            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas']);
            $table->string('harga_deal', 10);
            $table->timestamps();
            $table->foreign('id_kelas')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pembayaran');
    }
}
