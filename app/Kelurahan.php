<?php

namespace App;
use App\Kecamatan;

class Kelurahan extends Model
{
	public $incrementing = false;

    public function get_kecamatan() {
    	return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

	public function get_rw() {
    	return $this->hasMany(RukunWarga::class);
    }    
}
