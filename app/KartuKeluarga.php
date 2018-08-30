<?php

namespace App;

class KartuKeluarga extends Model
{
    public $incrementing = false;

    public function get_kepala_keluarga() {
        return $this->belongsTo(Penduduk::class, 'kepala_keluarga');
    }

    public function get_penduduk() {
        return $this->hasMany(Penduduk::class, 'kk_id')->whereNull('status');
    }

    public function get_kelurahan() {
        return $this->belongsTo(Kelurahan::class, 'kelurahan');
    }

    public function get_rt() {
        return $this->belongsTo(RukunTetangga::class, 'rukun_tetangga');
    }

    public function get_rw() {
        return $this->belongsTo(RukunWarga::class, 'rukun_warga');
    }
}
