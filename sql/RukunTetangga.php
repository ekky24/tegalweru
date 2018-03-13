<?php

namespace App;

class RT extends Model
{
    public function get_rw() {
    	return $this->belongsTo(RW::class);
    }
}
