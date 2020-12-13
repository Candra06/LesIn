<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogSaldo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_saldo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tentor');
            $table->integer('jumlah_saldo');
            $table->enum('jenis', ['Kredit', 'Debit']);
            $table->string('keterangan', 75);
            $table->timestamps();
            $table->foreign('id_tentor')->references('id')->on('data_tentor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_log_saldo');
    }
}
