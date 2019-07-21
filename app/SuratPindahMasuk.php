<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratPindahMasuk extends Model
{
    protected $fillable = ['nomor', 'nama_pemohon', 'kk_lama', 'alamat_asal', 'alamat_tujuan', 'alasan_pindah', 'created_at', 'updated_at'];
}
