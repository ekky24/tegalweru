<?php

namespace App;
use App\Kelurahan;

class Kecamatan extends Model
{
    public function get_kelurahan() {
    	return $this->hasMany(Kelurahan::class);
    }

    public function get_kota() {
    	return $this->belongsTo(Kota::class, 'kota_id');
    }
}
