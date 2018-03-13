<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;

class KecamatanController extends Controller
{
    public function kecamatan_ajax() {
        $kecamatan = Kecamatan::select('nama', 'id')->get();
    	return $kecamatan;
    }

    public function kecamatan_ajax_hasil(Kecamatan $kecamatan) {
        $kota_send = $kecamatan->get_kota;
        $provinsi_send = $kota_send->get_provinsi;

        $send = compact('kota_send', 'provinsi_send');
        return json_encode($send);
    }
}
