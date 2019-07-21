<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratPindahKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_pindah_keluars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor');
            $table->string('penduduk_id');
            $table->text('alamat_tujuan');
            $table->text('alasan_pindah');
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
        Schema::dropIfExists('surat_pindah_keluars');
    }
}
