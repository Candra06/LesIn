<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdRekening extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_pembayaran', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rekening')->after('jumlah_bayar');
            // $table->foreign('id_rekening')->references('id')->on('rekening');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_pembayaran', function (Blueprint $table) {
            //
        });
    }
}
