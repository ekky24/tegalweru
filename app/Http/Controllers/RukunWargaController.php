<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RukunWarga;
use App\Kelurahan;

class RukunWargaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
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
    		'nama' => request('nama'),
    		'ketua' => strtoupper(request('ketua')),
            'kelurahan_id' => '3507300006'
    	]);

    	return redirect('/rw');
    }

    public function show_all() {
        $rw = RukunWarga::paginate(10);
        return view('rw.show_all', compact('rw'));
    }

    public function edit(RukunWarga $rw) {
        return view('rw.edit', compact('rw'));
    }

    public function store_edit(RukunWarga $rw) {
        $this->validate(request(), [
            'nama' => 'required',
            'ketua' => 'required'
        ]);

        $rw->nama = "00" . request('nama');
        $rw->ketua = strtoupper(request('ketua'));
        $rw->save();

        return redirect('/rw');
    }
}
