<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_mapel', function (Blueprint $table) {
            $table->Enum('mapel', ['Matematika', 'Bahasa Inggris', 'Bahasa Indonesia', 'IPA'])->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_mapel', function (Blueprint $table) {
            //
        });
    }
}
