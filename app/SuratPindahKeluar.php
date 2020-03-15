<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratPindahKeluar extends Model
{
    protected $fillable = ['judul', 'nomor', 'penduduk_id', 'alamat_tujuan', 'alasan_pindah', 'penerbit_id', 'created_at', 'updated_at'];

    public function get_penduduk() {
    	return $this->belongsTo(Penduduk::class, 'penduduk_id')->with('get_kk');
    }

    public function get_penerbit() {
    	return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }

    public function get_pindah_keluar() {
    	return $this->hasMany(PindahKeluar::class, 'penduduk_id');
    }
}
