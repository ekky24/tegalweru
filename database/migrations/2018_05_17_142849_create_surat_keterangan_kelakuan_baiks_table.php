<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratKeteranganKelakuanBaiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keterangan_kelakuan_baiks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor');
            $table->string('penduduk_id');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('tempat_lahir_ayah');
            $table->string('tempat_lahir_ibu');
            $table->date('tgl_lahir_ayah');
            $table->date('tgl_lahir_ibu');
            $table->string('agama_ayah');
            $table->string('agama_ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('alamat_ayah');
            $table->string('alamat_ibu');
            $table->text('keperluan');
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
        Schema::dropIfExists('surat_keterangan_kelakuan_baiks');
    }
}
