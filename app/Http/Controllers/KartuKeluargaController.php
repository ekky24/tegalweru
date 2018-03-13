<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KartuKeluarga;
use App\RukunTetangga;
use App\RukunWarga;
use App\Kecamatan;
use App\Penduduk;

class KartuKeluargaController extends Controller
{
    public function insert() {
        $rw = RukunWarga::all();
    	return view('kk.insert', compact('rw'));
    }

    public function store() {
    	$this->validate(request(), [
    		'no_kk' => 'required|numeric',
    		'kepala_keluarga' => 'required|numeric',
    		'alamat' => 'required',
    		'rt' => 'required|numeric',
    		'rw' => 'required|numeric',
    		'kelurahan' => 'required',
    		'kecamatan' => 'required',
    		'kode_pos' => 'required|numeric',
    		'tgl_terbit' => 'required',
    		'penerbit' => 'required'
    	]);

        $kecamatan = Kecamatan::select('id')->where('nama', request('kecamatan'))->get();

    	KartuKeluarga::create([
    		'id' => request('no_kk'),
    		'kepala_keluarga' => request('kepala_keluarga'),
    		'alamat' => strtoupper(request('alamat')),
    		'rukun_tetangga' => '00' + request('rt'),
    		'rukun_warga' => '00' + request('rw'),
    		'kelurahan' => strtoupper(request('kelurahan')),
    		'kecamatan' => $kecamatan[0]->id,
    		'kode_pos' => request('kode_pos'),
    		'tgl_terbit' => request('tgl_terbit'),
    		'penerbit' => strtoupper(request('penerbit'))
    	]);

        if (request('list_nik') !== null) {
            $list_nik = request('list_nik');
            $data = explode("," ,$list_nik);

            foreach ($data as $row) {
                $find = Penduduk::find($row);
                $find = Penduduk::findOrFail($row);
                if ($find) {
                    $find->kk_id = request('no_kk');
                    $find->save();
                }
            }
        }

    	return redirect('/');
    }
}
