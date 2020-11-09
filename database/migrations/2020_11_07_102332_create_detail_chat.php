<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_chat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_room');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_tentor');
            $table->text('message');
            $table->enum('status', ['Diterima', 'Dibaca']);
            $table->timestamps();
            $table->foreign('id_room')->references('id')->on('room_chat');
            $table->foreign('id_siswa')->references('id')->on('data_siswa');
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
        Schema::dropIfExists('detail_chat');
    }
}
