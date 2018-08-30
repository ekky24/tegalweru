<?php

namespace App;

class RukunWarga extends Model
{
    public function get_rt() {
    	return $this->hasMany(RukunTetangga::class, 'rukun_warga_id');
    }

    public function get_kelurahan() {
    	return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

    public function get_kk() {
    	return $this->hasMany(KartuKeluarga::class, 'rukun_warga');
    }
}
