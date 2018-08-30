<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelurahan;

class KelurahanController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
}
