<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratIjinKeramaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_ijin_keramaians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor');
            $table->string('penduduk_id');
            $table->string('nama_acara');
            $table->date('tgl_acara');
            $table->string('jam_acara');
            $table->string('tempat_acara');
            $table->string('hiburan');
            $table->integer('jumlah_undangan')->nullable();
            $table->string('jenis_surat');
            $table->text('dari_pengantar')->nullable();
            $table->text('tgl_pengantar')->nullable();
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
        Schema::dropIfExists('surat_ijin_keramaians');
    }
}
