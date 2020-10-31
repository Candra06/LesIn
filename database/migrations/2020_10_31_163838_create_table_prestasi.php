<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePrestasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_prestasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tentor');
            $table->string('tingkatan', 50);
            $table->string('penghargaan', 50);
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
        Schema::dropIfExists('table_prestasi');
    }
}
