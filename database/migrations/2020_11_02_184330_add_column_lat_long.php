<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLatLong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_tentor', function (Blueprint $table) {
            $table->string('lattitude', 12)->after('hobi');
            $table->string('longitude', 12)->after('lattitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_tentor', function (Blueprint $table) {
            //
        });
    }
}
