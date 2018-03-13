<?php

namespace App;
use App\Agama;
use App\Pendidikan;
use App\JenisPekerjaan;
use App\StatusNikah;
use App\StatusHubungan;
use App\Kota;
use App\KartuKeluarga;

class Penduduk extends Model
{
    public $incrementing = false;

    public function get_kk() {
        return $this->belongsTo(KartuKeluarga::class, 'kk_id');
    }

    public function get_agama() {
    	return $this->belongsTo(Agama::class);
    }

    public function get_tempat_lahir() {
        return $this->belongsTo(Kota::class, 'tempat_lahir');
    }

    public function get_pendidikan() {
    	return $this->belongsTo(Pendidikan::class);
    }

    public function get_jenis_pekerjaan() {
    	return $this->belongsTo(JenisPekerjaan::class);
    }

    public function get_status_nikah() {
    	return $this->belongsTo(StatusNikah::class);
    }

    public function get_status_hubungan() {
    	return $this->belongsTo(StatusHubungan::class);
    }
}

