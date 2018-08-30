<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Penerbit;
use App\SuratKeteranganWaliNikah;
use Carbon\Carbon;
use DB;
use App\Penduduk;

class SuratKeteranganWaliNikahController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}

	public function insert() {
    	$penerbit = Penerbit::all();

    	return view('skwn.insert', compact('penerbit'));
    }

    public function store() {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'nama_nikah' => 'required',
    		'tempat_lahir_nikah' => 'required',
    		'tgl_lahir_nikah' => 'required',
    		'agama_nikah' => 'required',
    		'pekerjaan_nikah' => 'required',
    		'alamat_nikah' => 'required',
    		'penerbit_id' => 'required'
    	]);

        if (Penduduk::find(request('nik')) == null) {
            return back()->withErrors([
                'message' => 'NIK yang anda masukkan salah.'
            ]);
        }

    	$cek = SuratKeteranganWaliNikah::latest()->first();
    	$now = Carbon::now();
    	$tahun = $now->year;
    
    	if ($cek == null) {
    		$nomor_sebelum = 0;
    	}
    	else {
    		$nomor_temp = $cek->nomor;
    		$tahun_temp = substr($nomor_temp, -4);

    		if ($tahun_temp < $tahun) {
    			$nomor_sebelum = 0;
    		}
    		else {
    			$get_last = substr($nomor_temp, 4);
    			$pos = strpos($get_last, '/');
    			$nomor_sebelum = substr($get_last, 0, $pos);
    		}
    	}

    	$nomor_sesudah = $nomor_sebelum + 1;
    	$nomor_fix = "140/" . $nomor_sesudah . "/35.07.2006/" . $tahun;

    	$skwn = SuratKeteranganWaliNikah::create([
    		'nomor' => $nomor_fix,
    		'penduduk_id' => request('nik'),
    		'nama_nikah' => strtoupper(request('nama_nikah')),
    		'tempat_lahir_nikah' => strtoupper(request('tempat_lahir_nikah')),
    		'tgl_lahir_nikah' => request('tgl_lahir_nikah'),
    		'agama_nikah' => strtoupper(request('agama_nikah')),
    		'pekerjaan_nikah' => strtoupper(request('pekerjaan_nikah')),
    		'alamat_nikah' => strtoupper(request('alamat_nikah')),
    		'penerbit_id' => request('penerbit_id')
    	]);

    	return redirect("/skwn/$skwn->id");
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$skwn = SuratKeteranganWaliNikah::with(['get_penduduk', 'get_penerbit']);

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $skwn = $skwn->whereRaw("year(created_at) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $skwn = $skwn->whereRaw("month(created_at) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $skwn = $skwn->orWhere('penduduk_id', "like", "%" . request('q'). "%")->orWhere('nama_nikah', "like", "%" . request('q'). "%")->orWhere('penerbit_id', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }

        $skwn_download = $skwn->get();
        $skwn = $skwn->paginate(15);
    	
    	return view('skwn.show_all', compact('skwn', 'search_term', 'tahun_choose', 'bulan_choose', 'skwn_download'));
    }

    public function getPdf() {
        $this->validate(request(), [
            'surat_download' => 'required',
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
        
        $surat = json_decode(request('surat_download'));

        $pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('skwn.pdf', compact('surat', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function show($id) {
    	$skwn = SuratKeteranganWaliNikah::with(['get_penduduk', 'get_penerbit'])->find($id);
    	return view('skwn.show', compact('skwn'));
    }

    public function edit($id) {
    	$penerbit = Penerbit::all();
    	$skwn = SuratKeteranganWaliNikah::with(['get_penduduk', 'get_penerbit'])->find($id);
    	return view('skwn.edit', compact('skwn', 'penerbit'));
    }

    public function store_edit(SuratKeteranganWaliNikah $skwn) {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'nama_nikah' => 'required',
    		'tempat_lahir_nikah' => 'required',
    		'tgl_lahir_nikah' => 'required',
    		'agama_nikah' => 'required',
    		'pekerjaan_nikah' => 'required',
    		'alamat_nikah' => 'required',
    		'penerbit_id' => 'required'
    	]);

    	$skwn->nama_nikah = strtoupper(request('nama_nikah'));
    	$skwn->tempat_lahir_nikah = strtoupper(request('tempat_lahir_nikah'));
    	$skwn->tgl_lahir_nikah = request('tgl_lahir_nikah');
    	$skwn->agama_nikah = strtoupper(request('agama_nikah'));
    	$skwn->pekerjaan_nikah = strtoupper(request('pekerjaan_nikah'));
    	$skwn->alamat_nikah = strtoupper(request('alamat_nikah'));
    	$skwn->penerbit_id = strtoupper(request('penerbit_id'));
    	$skwn->save();

    	return redirect("/skwn/$skwn->id");
    }

    public function delete(SuratKeteranganWaliNikah $skwn) {
    	$skwn->delete();
    	return redirect('/skwn');
    }

    public function print($id) {
    	$surat = SuratKeteranganWaliNikah::with(['get_penduduk', 'get_penerbit'])->find($id);
        $penduduk = Penduduk::with(['get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);

    	$pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('skwn.print', compact('surat', 'penduduk'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function stat_skwn_tahun(Request $request) {
    	$data = [];
    	$i = [0,0,0,0,0,0,0,0,0,0,0,0];

    	if ($request->has('tahun')) {
    		$count_month = SuratKeteranganWaliNikah::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();	
    	}
    	else {
    		$now = Carbon::now();
    		$count_month = SuratKeteranganWaliNikah::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
    	}

        foreach ($count_month as $row) {
        	$i[$row->month - 1] = $row->count;
        }
        
        foreach ($i as $index => $row) {
        	$send['count'] = $row;
        	$send['month'] = $index + 1;
        	array_push($data, $send);
        }

        return json_encode($data);
    }

    public function stat_skwn_bulan(Request $request) {
    	$data = [];
    	$i = [0,0,0,0];

    	if ($request->has('bulan')) {
    		$count_week = SuratKeteranganWaliNikah::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
    	}
    	else {
    		$now = Carbon::now();
    		$count_week = SuratKeteranganWaliNikah::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
    	}

        foreach ($count_week as $row) {
        	$i[$row->week - 1] = $row->count;
        }
        
        foreach ($i as $index => $row) {
        	$send['count'] = $row;
        	$send['week'] = $index + 1;
        	array_push($data, $send);
        }

        return json_encode($data);
    }
}
