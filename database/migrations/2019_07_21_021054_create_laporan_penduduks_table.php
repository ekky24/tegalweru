<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanPenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_penduduks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lahir_l');
            $table->integer('lahir_p');
            $table->integer('mati_l');
            $table->integer('mati_p');
            $table->integer('pindah_masuk_l');
            $table->integer('pindah_masuk_p');
            $table->integer('pindah_keluar_l');
            $table->integer('pindah_keluar_p');
            $table->integer('penduduk_akhir_l');
            $table->integer('penduduk_akhir_p');
            $table->integer('rt');
            $table->integer('rw');
            $table->integer('kk');
            $table->date('laporan_bulan');
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
        Schema::dropIfExists('laporan_penduduks');
    }
}
