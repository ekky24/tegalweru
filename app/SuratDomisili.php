<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratDomisili extends Model
{
	protected $fillable = ['judul', 'nomor', 'penduduk_id', 'dari_pengantar', 'tgl_pengantar', 'penerbit_id', 'created_at', 'updated_at'];

    public function get_penduduk() {
    	return $this->belongsTo(Penduduk::class, 'penduduk_id')->with('get_kk');
    }

    public function get_penerbit() {
    	return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }
}
