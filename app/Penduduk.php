<?php

namespace App;
use App\Agama;
use App\Pendidikan;
use App\JenisPekerjaan;
use App\StatusNikah;
use App\StatusHubungan;
use App\Kota;
use App\KartuKeluarga;
use App\PenyandangCacat;

class Penduduk extends Model
{
    public $incrementing = false;

    public function get_kk() {
        return $this->belongsTo(KartuKeluarga::class, 'kk_id');
    }

    public function get_agama() {
    	return $this->belongsTo(Agama::class, 'agama_id');
    }

    public function get_tempat_lahir() {
        return $this->belongsTo(Kota::class, 'tempat_lahir');
    }

    public function get_pendidikan() {
    	return $this->belongsTo(Pendidikan::class, 'pendidikan_id');
    }

    public function get_jenis_pekerjaan() {
    	return $this->belongsTo(JenisPekerjaan::class, 'jenis_pekerjaan_id');
    }

    public function get_status_nikah() {
    	return $this->belongsTo(StatusNikah::class, 'status_nikah_id');
    }

    public function get_status_hubungan() {
    	return $this->belongsTo(StatusHubungan::class, 'status_hubungan_id');
    }

    public function get_penyandang_cacat() {
        return $this->belongsTo(PenyandangCacat::class, 'penyandang_cacat_id');
    }

    public function get_kematian() {
        return $this->hasMany(Kematian::class, 'penduduk_id');
    }

    public function scopeGetAktif($query) {
        return $query->whereNull('status');
    }
}

