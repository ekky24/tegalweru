<?php

namespace App;

class SuratKeteranganKenalLahir extends Model
{
    public function get_penduduk() {
    	return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    public function get_penerbit() {
    	return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }
}
