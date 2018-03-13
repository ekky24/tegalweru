<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RT;

class RTController extends Controller
{
    public function insert() {
    	return view('rt.insert');
    }

    public function store() {
    	$this->validate(request(), [
    		'rw_id' => 'required|numeric',
    		'nama' => 'required',
    		'ketua' => 'required'
    	]);

    	RT::create([
    		'rw_id' => request('rw_id'),
    		'nama' => request('nama'),
    		'ketua' => request('ketua'),
    	]);

    	return redirect('/');
    }
}
