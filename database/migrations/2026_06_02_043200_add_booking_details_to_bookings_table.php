<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('no_sim')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('jaminan')->nullable();
            $table->string('status_penyewa')->default('Ready');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['nama', 'no_ktp', 'no_sim', 'no_hp', 'alamat', 'jaminan', 'status_penyewa']);
        });
    }
};