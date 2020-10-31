<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRiwayatPendidikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tentor');
            $table->enum('jenjang_pendidikan', ['SD', 'SMP', 'SMA', 'Universitas']);
            $table->enum('status_pendidikan', ['Lulus', 'Sedang Menempuh']);
            $table->string('tahun_lulus', 4);
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
        Schema::dropIfExists('table_riwayat_pendidikan');
    }
}
