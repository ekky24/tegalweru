<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratPindahMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pindah_masuks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor');
            $table->string('nama_pemohon');
            $table->string('kk_lama')->nullable();
            $table->text('alamat_asal');
            $table->text('alamat_tujuan');
            $table->string('alasan_pindah');
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
        Schema::dropIfExists('surat_pindah_masuks');
    }
}
