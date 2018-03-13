<?php

namespace App;

class RW extends Model
{
    public function get_rt() {
    	return $this->hasMany(RT::class);
    }
}
