<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->enum('jenis', ['Motor', 'Mobil'])->default('Motor');
        });
    }

    public function down()
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
};