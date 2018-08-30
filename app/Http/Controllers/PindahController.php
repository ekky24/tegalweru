<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Pindah;
use App\Penduduk;

class PindahController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function insert() {
    	return view('pindah.insert');
    }

    public function store() {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'alamat_asal' => 'required',
    		'alamat_tujuan' => 'required',
    		'alasan' => 'required'
    	]);

        if (Penduduk::find(request('nik')) == null) {
            return back()->withErrors([
                'message' => 'NIK yang anda masukkan salah.'
            ]);
        }

    	Pindah::create([
    		'penduduk_id' => request('nik'),
    		'alamat_asal' => strtoupper(request('alamat_asal')),
    		'alamat_tujuan' => strtoupper(request('alamat_tujuan')),
    		'alasan' => strtoupper(request('alasan'))
    	]);

    	$penduduk = Penduduk::find(request('nik'));
    	$penduduk->status = "2";
    	$penduduk->save();

    	return redirect('/pindah');
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$pindah = Pindah::with('get_penduduk');

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $pindah = $pindah->whereRaw("year(created_at) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $pindah = $pindah->whereRaw("month(created_at) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $pindah = $pindah->orWhere('penduduk_id', "like", "%" . request('q'). "%")->orWhere('alamat_asal', "like", "%" . request('q'). "%")->orWhere('alamat_tujuan', "like", "%" . request('q'). "%")->orWhere('alasan', "like", "%" . request('q'). "%")->orWhere('created_at', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }

        $pindah_download = $pindah->get();
        $pindah = $pindah->paginate(15);
    	
    	return view('pindah.show_all', compact('pindah', 'search_term', 'tahun_choose', 'bulan_choose', 'pindah_download'));
    }

    public function getPdf() {
        $this->validate(request(), [
            'pindah_download' => 'required',
        ]);

        $tahun_choose = "Semua Tahun";
        $bulan_choose = "Semua Bulan";
        $search_term = "-";

        if (request('tahun_choose') != "") {
            $tahun_choose = request('tahun_choose');
        }
        if (request('bulan_choose') != "") {
            $bulan_choose = request('bulan_choose');
        }
        if (request('search_term') != "") {
            $search_term = request('search_term');
        }
        
        $pindah = json_decode(request('pindah_download'));

        $pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('pindah.pdf', compact('pindah', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function edit(Pindah $pindah) {
    	$pindah->get_penduduk;
    	return view('pindah.edit', compact('pindah'));
    }

    public function store_edit(Pindah $pindah) {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'alamat_asal' => 'required',
    		'alamat_tujuan' => 'required',
    		'alasan' => 'required'
    	]);

    	$pindah->alamat_asal = strtoupper(request('alamat_asal'));
    	$pindah->alamat_tujuan = strtoupper(request('alamat_tujuan'));
    	$pindah->alasan = strtoupper(request('alasan'));
    	$pindah->save();

    	return redirect('/pindah');
    }

    public function delete(Pindah $pindah) {
    	$penduduk = $pindah->get_penduduk;
    	$penduduk->status = NULL;
    	$penduduk->save();

    	$pindah->delete();
    	return redirect('/pindah');
    }
}
