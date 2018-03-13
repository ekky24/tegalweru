<?php

namespace App;

class RukunTetangga extends Model
{
    public function get_rw() {
    	return $this->belongsTo(RukunWarga::class, 'rukun_warga_id');
    }
}
