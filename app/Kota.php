<?php

namespace App;

class Kota extends Model
{
    public function get_provinsi() {
    	return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
}
