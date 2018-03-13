<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RW;

class RWController extends Controller
{
    public function insert() {
    	return view('rw.insert');
    }

    public function store() {
    	$this->validate(request(), [
    		'nama' => 'required',
    		'ketua' => 'required'
    	]);

    	RW::create([
    		'nama' => request('nama'),
    		'ketua' => request('ketua'),
    	]);

    	return redirect('/');
    }
}
