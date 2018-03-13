<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KK;

class KKController extends Controller
{
    public function insert() {
    	return view('kk.insert');
    }

    public function store() {
    	$this->validate(request(), [
    		'no_kk' => 'required|numeric',
    		'kepala_keluarga' => 'required|numeric',
    		'alamat' => 'required',
    		'rt' => 'required|numeric',
    		'rw' => 'required|numeric',
    		'kelurahan' => 'required|numeric',
    		'kecamatan' => 'required|numeric',
    		'kota' => 'required|numeric',
    		'kode_pos' => 'required|numeric',
    		'provinsi' => 'required|numeric',
    		'tgl_terbit' => 'required',
    		'penerbit' => 'required|numeric'
    	]);

    	KK::create([
    		'id' => request('no_kk'),
    		'kepala_keluarga' => request('kepala_keluarga'),
    		'alamat' => request('alamat'),
    		'rt' => request('rt'),
    		'rw' => request('rw'),
    		'kelurahan' => request('kelurahan'),
    		'kecamatan' => request('kecamatan'),
    		'kota' => request('kota'),
    		'kode_pos' => request('kode_pos'),
    		'provinsi' => request('provinsi'),
    		'tgl_terbit' => request('tgl_terbit'),
    		'penerbit' => request('penerbit')
    	]);

    	return redirect('/');
    }
}
