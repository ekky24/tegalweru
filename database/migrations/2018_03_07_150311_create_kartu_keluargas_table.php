<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKartuKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_keluargas', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('kepala_keluarga');
            $table->text('alamat');
            $table->string('rukun_tetangga');
            $table->string('rukun_warga');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kode_pos');
            $table->date('tgl_terbit');
            $table->string('penerbit');
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
        Schema::dropIfExists('kartu_keluargas');
    }
}
