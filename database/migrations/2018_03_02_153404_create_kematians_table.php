<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKematiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kematians', function (Blueprint $table) {
            $table->string('penduduk_id')->primary();
            $table->string('nomor');
            $table->string('tempat_kematian');
            $table->date('tgl_kematian');
            $table->string('jam_kematian');
            $table->string('penyebab_kematian');
            $table->string('nik_pelapor');
            $table->string('hubungan_pelapor');
            $table->string('penerbit_id');
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
        Schema::dropIfExists('kematians');
    }
}
