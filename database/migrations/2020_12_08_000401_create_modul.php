<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modul', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 50);
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_tentor');
            $table->string('file', 50);
            $table->string('materi', 50);
            $table->timestamps();
            $table->foreign('id_kelas')->references('id')->on('kelas');
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
        Schema::dropIfExists('modul');
    }
}
