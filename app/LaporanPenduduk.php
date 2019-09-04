<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanPenduduk extends Model
{
    protected $fillable = ['lahir_l', 'lahir_p', 'mati_l', 'mati_p', 'pindah_masuk_l', 'pindah_masuk_l', 'pindah_masuk_p', 'pindah_keluar_l', 'pindah_keluar_p', 'penduduk_akhir_l', 'penduduk_akhir_p', 'rt', 'rw', 'kk', 'laporan_bulan', 'created_at', 'updated_at'];
}
