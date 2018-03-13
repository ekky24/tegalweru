<?php

namespace App;
use App\Penduduk;

class JenisPekerjaan extends Model
{
    public function get_penduduk() {
    	return $this->hasMany(Penduduk::class);
    }
}
