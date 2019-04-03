<?php

namespace App;

class SuratKeteranganDukun extends Model
{
    public function get_penduduk_ibu() {
    	return $this->belongsTo(Penduduk::class, 'nik_ibu');
    }

    public function get_penduduk_ayah() {
    	return $this->belongsTo(Penduduk::class, 'nik_ayah');
    }

    public function get_penduduk_pelapor() {
    	return $this->belongsTo(Penduduk::class, 'nik_pelapor');
    }

    public function get_penerbit() {
    	return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }
}
