<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Kematian;
use App\Penduduk;

class KematianController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function insert() {
    	return view('kematian.insert');
    }

    public function store() {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'tempat' => 'required',
    		'tgl_kematian' => 'required',
    		'jam_kematian' => 'required',
    		'tempat_pemakaman' => 'required'
    	]);

        if (Penduduk::find(request('nik')) == null) {
            return back()->withErrors([
                'message' => 'NIK yang anda masukkan salah.'
            ]);
        }

    	$tgl_kematian = request('tgl_kematian');
    	$jam_kematian = request('jam_kematian');
    	$waktu_kematian = date('Y-m-d H:i:s', strtotime("$tgl_kematian $jam_kematian"));

    	Kematian::create([
    		'penduduk_id' => request('nik'),
    		'tempat_kematian' => strtoupper(request('tempat')),
    		'waktu_kematian' => $waktu_kematian,
    		'tempat_pemakaman' => strtoupper(request('tempat_pemakaman'))
    	]);

    	$penduduk = Penduduk::find(request('nik'));
    	$penduduk->status = "1";
    	$penduduk->save();

    	return redirect('/kematian');
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$kematian = Kematian::with('get_penduduk');

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $kematian = $kematian->whereRaw("year(waktu_kematian) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $kematian = $kematian->whereRaw("month(waktu_kematian) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $kematian = $kematian->orWhere('penduduk_id', "like", "%" . request('q'). "%")->orWhere('tempat_kematian', "like", "%" . request('q'). "%")->orWhere('waktu_kematian', "like", "%" . request('q'). "%")->orWhere('tempat_pemakaman', "like", "%" . request('q'). "%")->orWhere('created_at', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }

        $kematian_download = $kematian->get();
        $kematian = $kematian->paginate(15);

    	return view('kematian.show_all', compact('kematian', 'tahun_choose', 'bulan_choose', 'search_term', 'kematian_download'));
    }

    public function getPdf() {
        $this->validate(request(), [
            'kematian_download' => 'required',
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
        
        $kematian = json_decode(request('kematian_download'));

        $pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('kematian.pdf', compact('kematian', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function edit(Kematian $kematian) {
    	$kematian->get_penduduk;
    	return view('kematian.edit', compact('kematian'));
    }

    public function store_edit(Kematian $kematian) {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'tempat' => 'required',
    		'tgl_kematian' => 'required',
    		'jam_kematian' => 'required',
    		'tempat_pemakaman' => 'required'
    	]);

    	$tgl_kematian = request('tgl_kematian');
    	$jam_kematian = request('jam_kematian');
    	$waktu_kematian = date('Y-m-d H:i:s', strtotime("$tgl_kematian $jam_kematian"));

    	$kematian->tempat_kematian = strtoupper(request('tempat'));
    	$kematian->waktu_kematian = $waktu_kematian;
    	$kematian->tempat_pemakaman = strtoupper(request('tempat_pemakaman'));
    	$kematian->save();

    	return redirect('/kematian');
    }

    public function delete(Kematian $kematian) {
    	$penduduk = $kematian->get_penduduk;
    	$penduduk->status = NULL;
    	$penduduk->save();

    	$kematian->delete();
    	return redirect('/kematian');
    }
}
