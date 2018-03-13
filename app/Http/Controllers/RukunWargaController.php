<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RukunWarga;
use App\Kelurahan;

class RukunWargaController extends Controller
{
    public function insert() {
        $kelurahan = Kelurahan::all();
    	return view('rw.insert', compact('kelurahan'));
    }

    public function store() {
    	$this->validate(request(), [
    		'nama' => 'required|numeric',
    		'ketua' => 'required'
    	]);

    	RukunWarga::create([
    		'nama' => "RUKUN WARGA " . request('nama'),
    		'ketua' => strtoupper(request('ketua')),
            'kelurahan_id' => '3507300006'
    	]);

    	return redirect('/');
    }
}
