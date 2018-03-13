<?php

namespace App;
use App\Penduduk;

class Agama extends Model
{
    public function get_penduduk() {
    	return $this->hasMany(Penduduk::class);
    }
}
