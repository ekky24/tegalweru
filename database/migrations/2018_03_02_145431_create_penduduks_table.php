<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama');
            $table->string('jk');
            $table->integer('tempat_lahir');
            $table->date('tgl_lahir');
            $table->integer('agama_id')->nullable();
            $table->integer('pendidikan_id')->nullable();
            $table->integer('jenis_pekerjaan_id')->nullable();
            $table->integer('status_nikah_id')->nullable();
            $table->integer('status_hubungan_id')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('no_paspor')->nullable();
            $table->string('no_kitas')->nullable();
            $table->string('ayah')->nullable();
            $table->string('ibu')->nullable();
            $table->string('kk_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('penduduks');
    }
}
