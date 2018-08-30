<?php

namespace App;

class Pindah extends Model
{
    protected $primaryKey = 'penduduk_id';
	public $incrementing = false;

    public function get_penduduk() {
    	return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }
}
