<?php

namespace App;

class KK extends Model
{
    public function get_penduduk() {
    	return $this->hasMany(Penduduk::class);
    }

    public function get_rt() {
    	return $this->belongsTo(RT::class);
    }

    public function get_rw() {
    	return $this->belongsTo(RW::class);
    }

    public function get_kelurahan() {
    	return $this->belongsTo(Kelurahan::class);
    }

    public function get_kecamatan() {
    	return $this->belongsTo(Kecamatan::class);
    }

    public function get_kota() {
    	return $this->belongsTo(Kota::class);
    }

    public function get_provinsi() {
    	return $this->belongsTo(Provinsi::class);
    }

    public function get_penerbit() {
    	return $this->belongsTo(Penerbit::class);
    }
}
