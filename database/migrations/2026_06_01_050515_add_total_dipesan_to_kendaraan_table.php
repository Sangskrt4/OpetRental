<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->integer('total_dipesan')->default(0);
        });
    }

    public function down()
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->dropColumn('total_dipesan');
        });
    }
};