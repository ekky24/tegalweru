<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PindahMasuk extends Model
{
    protected $fillable = ['penduduk_id', 'surat_masuk_id'];

    public function get_penduduk() {
    	return $this->belongsTo(Penduduk::class, 'penduduk_id')->with(['get_status_nikah', 'get_status_hubungan']);
    }
}