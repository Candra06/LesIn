<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_tentor');
            $table->unsignedBigInteger('id_mapel');
            $table->string('tarif', 13);
            $table->integer('jumlah_pertemuan');
            $table->integer('pertemuan');
            $table->enum('status',['Aktif', 'Pending', 'Selesai'])->default('Pending');
            $table->timestamps();
            $table->foreign('id_siswa')->references('id')->on('data_siswa');
            $table->foreign('id_tentor')->references('id')->on('data_tentor');
            $table->foreign('id_mapel')->references('id')->on('data_mapel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
