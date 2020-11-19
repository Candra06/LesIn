<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDataMengajarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_mengajar', function (Blueprint $table) {
            $table->enum('status', ['Aktif', 'Banned'])->after('id_mapel')->default('Aktif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_mengajar', function (Blueprint $table) {
            //
        });
    }
}
