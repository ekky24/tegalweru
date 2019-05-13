<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

class SessionController extends Controller
{
	public function __construct() {
		$this->middleware('guest')->except(['logout', 'ubah_pass', 'store_pass']);
	}

    public function create() {
    	return view('session.login');
    }

    public function store() {
    	if (! auth()->attempt(request(['username', 'password']))) {
    		return back()->withErrors([
    			'message' => 'Username atau password yang anda masukkan salah.'
    		]);
    	}

    	return redirect('/');
    }

    public function ubah_pass() {
        return view('session.ubah_pass');
    }

    public function store_pass() {
        $this->validate(request(), [
            'pass_lama' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        if (! password_verify(request('pass_lama'), auth()->user()->password)) {
            return back()->withErrors([
                'message' => 'Password yang anda masukkan salah.'
            ]);
        }

        $password = Hash::make(request('password'));
        
        $user = auth()->user();
        $user->password = $password;
        $user->save();

        return redirect('/');
    }

    public function logout() {
    	auth()->logout();
    	return redirect('/');
    }
}
