<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RukunTetangga;
use App\RukunWarga;

class RukunTetanggaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function insert() {
        $rw = RukunWarga::all();
    	return view('rt.insert', compact('rw'));
    }

    public function show_all() {
        $rt = RukunTetangga::paginate(15);
        return view('rt.show_all', compact('rt'));
    }

    public function edit(RukunTetangga $rt) {
        $rw = RukunWarga::all();
        return view('rt.edit', compact('rt', 'rw'));
    }

    public function store() {
    	$this->validate(request(), [
    		'rukun_warga_id' => 'required|numeric',
    		'nama' => 'required|numeric',
    		'ketua' => 'required'
    	]);

    	RukunTetangga::create([
    		'rukun_warga_id' => request('rukun_warga_id'),
    		'nama' => request('nama'),
    		'ketua' => strtoupper(request('ketua')),
    	]);

    	return redirect('/rt');
    }

    public function store_edit(RukunTetangga $rt) {
        $this->validate(request(), [
            'rukun_warga_id' => 'required|numeric',
            'nama' => 'required|numeric',
            'ketua' => 'required'
        ]);

        $rt->rukun_warga_id = request('rukun_warga_id');
        $rt->nama = request('nama');
        $rt->ketua = strtoupper(request('ketua'));
        $rt->save();

        return redirect('/rt');
    }
}
