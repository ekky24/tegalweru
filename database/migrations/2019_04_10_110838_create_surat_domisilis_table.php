<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratDomisilisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_domisilis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor');
            $table->string('penduduk_id');
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
        Schema::dropIfExists('surat_domisilis');
    }
}
