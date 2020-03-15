<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratIjinKeramaian extends Model
{
    protected $fillable = ['judul', 'nomor', 'penduduk_id', 'nama_acara', 'tgl_acara', 'jam_acara', 'tempat_acara', 'hiburan', 'jumlah_undangan', 'jenis_surat', 'penerbit_id', 'created_at', 'updated_at'];

    public function get_penduduk() {
    	return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    public function get_penerbit() {
    	return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }
}
