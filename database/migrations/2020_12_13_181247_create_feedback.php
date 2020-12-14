<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tentor');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_siswa');
            $table->text('feedback');
            $table->string('rating');
            $table->timestamps();
            $table->foreign('id_tentor')->references('id')->on('data_tentor');
            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->foreign('id_siswa')->references('id')->on('data_siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
