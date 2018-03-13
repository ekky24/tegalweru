<?php

namespace App;

class RukunWarga extends Model
{
    public function get_rt() {
    	return $this->hasMany(RukunTetangga::class);
    }

    public function get_kelurahan() {
    	return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }
}
