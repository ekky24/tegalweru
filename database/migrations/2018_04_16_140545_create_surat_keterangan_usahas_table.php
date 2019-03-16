<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratKeteranganUsahasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keterangan_usahas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor');
            $table->string('penduduk_id');
            $table->string('nama_usaha');
            $table->string('tahun_pendirian_usaha')->nullable();
            $table->string('bidang_usaha')->nullable();
            $table->string('alamat_usaha')->nullable();
            $table->string('nama_pimpinan')->nullable();
            $table->string('alamat_pimpinan')->nullable();
            $table->integer('sendiri_sawah')->nullable();
            $table->integer('sendiri_tegal')->nullable();
            $table->integer('sewa_sawah')->nullable();
            $table->integer('sewa_tegal')->nullable();
            $table->text('keperluan')->nullable();
            $table->text('dari_pengantar')->nullable();
            $table->text('tgl_pengantar')->nullable();
            $table->string('penerbit_id');
            $table->string('jenis_surat');
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
        Schema::dropIfExists('surat_keterangan_usahas');
    }
}
