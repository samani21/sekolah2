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
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nik','20');
            $table->string('nis','20');
            $table->string('nama','50');
            $table->string('alamat','100');
            $table->date('tgl');
            $table->string('tempat','50');
            $table->string('agama','10');
            $table->string('jk','10');
            $table->string('kelas','20');
            $table->string('tahun','20');
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
        Schema::dropIfExists('data_siswa');
    }
};
