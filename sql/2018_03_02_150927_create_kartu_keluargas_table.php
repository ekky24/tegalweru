<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKKsTable extends Migration
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
            $table->integer('rt');
            $table->integer('rw');
            $table->integer('kelurahan');
            $table->integer('kecamatan');
            $table->integer('kota');
            $table->string('kode_pos');
            $table->integer('provinsi');
            $table->date('tgl_terbit');
            $table->integer('penerbit');
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
