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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nis','20');
            $table->string('nama','50');
            $table->string('nik','20');
            $table->string('alamat','100');
            $table->date('tgl');
            $table->string('tgl_absen','20');
            $table->string('tgl_harian','20');
            $table->string('tempat','50');
            $table->string('agama','10');
            $table->string('jk','10');
            $table->string('tahun','20');
            $table->integer('poin');
            $table->string('presensi','10');
            $table->string('foto');
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
        Schema::dropIfExists('tb_siswa');
    }
};
