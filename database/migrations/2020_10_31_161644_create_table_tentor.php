<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTentor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tentor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_akun');
            $table->string('nama', 45);
            $table->string('telepon', 13);
            $table->string('wa', 13);
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->text('motto');
            $table->integer('saldo_dompet');
            $table->timestamps();
            $table->foreign('id_akun')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_tentor');
    }
}
