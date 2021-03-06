<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColomKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['Lunas', 'Belum Lunas'])->after('status');
            $table->integer('harga_deal')->after('tarif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            //
        });
    }
}
