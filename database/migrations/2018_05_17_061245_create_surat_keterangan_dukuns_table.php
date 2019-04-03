<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratKeteranganDukunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keterangan_dukuns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor');
            $table->string('nik_ibu');
            $table->string('nik_ayah');
            $table->string('nik_pelapor');
            $table->string('hubungan_pelapor');
            $table->date('tgl_kelahiran');
            $table->string('jam_kelahiran');
            $table->string('tempat_kelahiran');
            $table->string('nama_anak');
            $table->string('jk_anak');
            $table->integer('anak_ke');
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
        Schema::dropIfExists('surat_keterangan_dukuns');
    }
}
