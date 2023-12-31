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
        Schema::create('tb_guru', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nip','20');
            $table->string('nama','50');
            $table->string('nik','20');
            $table->string('alamat','100');
            $table->date('tgl');
            $table->string('tempat','50');
            $table->string('agama','10');
            $table->string('jk','10');
            $table->string('status','20');
            $table->string('wakel','20');
            $table->string('tgl_absen','20');
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
        Schema::dropIfExists('tb_guru');
    }
};
