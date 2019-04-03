<?php

namespace App;

class Kematian extends Model
{
	protected $primaryKey = 'penduduk_id';
	public $incrementing = false;

    public function get_penduduk() {
    	return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    public function get_penerbit() {
    	return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }
}
