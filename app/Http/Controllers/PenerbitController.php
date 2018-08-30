<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penerbit;

class PenerbitController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function insert() {
    	return view('penerbit.insert');
    }

    public function store() {
    	$this->validate(request(), [
    		'nip' => 'required',
    		'nama' => 'required',
    		'jabatan' => 'required'
    	]);

    	Penerbit::create([
    		'id' =>request('nip'),
    		'nama' => strtoupper(request('nama')),
    		'jabatan' => strtoupper(request('jabatan'))
    	]);

    	return redirect('/penerbit');
    }

    public function store_edit(Penerbit $penerbit) {
    	$this->validate(request(), [
    		'nip' => 'required',
    		'nama' => 'required',
    		'jabatan' => 'required'
    	]);

    	$penerbit->nama = strtoupper(request('nama'));
    	$penerbit->jabatan = strtoupper(request('jabatan'));
    	$penerbit->save();

    	return redirect('/penerbit');
    }

    public function show_all() {
    	$penerbit = Penerbit::all();
    	return view('penerbit.show_all', compact('penerbit'));
    }

    public function edit(Penerbit $penerbit) {
    	return view('penerbit.edit', compact('penerbit'));
    }

    public function delete(Penerbit $penerbit) {
    	$penerbit->delete();
    	return redirect('/penerbit');
    }
}
