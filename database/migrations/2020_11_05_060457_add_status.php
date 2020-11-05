<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_pembayaran', function (Blueprint $table) {
            $table->enum('status', ['Confirmed', 'Penidng', 'Ditolak'])->after('confirmed_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_pembayaran', function (Blueprint $table) {
            //
        });
    }
}
