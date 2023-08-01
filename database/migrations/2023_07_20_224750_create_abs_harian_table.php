<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abs_harian', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');
            $table->integer('id_user');
            $table->date('tgl');
            $table->string('tahun','20');
            $table->string('jam','20');
            $table->string('kelas','20');
            $table->integer('semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abs_harian');
    }
};
