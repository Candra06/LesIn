<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPembayaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pembayaran');
            $table->string('bukti_tf', 20);
            $table->dateTime('tanggal_bayar');
            $table->string('jumlah_bayar', 10);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('confirmed_by');
            $table->timestamps();
            $table->foreign('id_pembayaran')->references('id')->on('data_pembayaran');
            $table->foreign('created_by')->references('id_akun')->on('data_siswa');
            $table->foreign('confirmed_by')->references('id_akun')->on('data_tentor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_pembayaran');
    }
}
