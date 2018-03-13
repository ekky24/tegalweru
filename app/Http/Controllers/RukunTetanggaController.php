<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RukunTetangga;
use App\RukunWarga;

class RukunTetanggaController extends Controller
{
    public function insert() {
        $rw = RukunWarga::all();
    	return view('rt.insert', compact('rw'));
    }

    public function store() {
    	$this->validate(request(), [
    		'rukun_warga_id' => 'required|numeric',
    		'nama' => 'required|numeric',
    		'ketua' => 'required'
    	]);

    	RukunTetangga::create([
    		'rukun_warga_id' => request('rukun_warga_id'),
    		'nama' => "RUKUN TETANGGA " . request('nama'),
    		'ketua' => strtoupper(request('ketua')),
    	]);

    	return redirect('/');
    }
}
