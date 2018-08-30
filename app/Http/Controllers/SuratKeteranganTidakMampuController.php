<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Penerbit;
use App\SuratKeteranganTidakMampu;
use Carbon\Carbon;
use DB;
use App\Penduduk;

class SuratKeteranganTidakMampuController extends Controller
{
	public function __construct() {
		return $this->middleware('auth');
	}

    public function insert() {
    	$penerbit = Penerbit::all();

    	return view('sktm.insert', compact('penerbit'));
    }

    public function store() {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'keperluan' => 'required',
    		'penerbit_id' => 'required'
    	]);

        if (Penduduk::find(request('nik')) == null) {
            return back()->withErrors([
                'message' => 'NIK yang anda masukkan salah.'
            ]);
        }

    	$cek = SuratKeteranganTidakMampu::latest()->first();
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

    	$sktm = SuratKeteranganTidakMampu::create([
    		'nomor' => $nomor_fix,
    		'penduduk_id' => request('nik'),
    		'keperluan' => strtoupper(request('keperluan')),
    		'penerbit_id' => request('penerbit_id')
    	]);

    	return redirect("/sktm/$sktm->id");
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$sktm = SuratKeteranganTidakMampu::with(['get_penduduk', 'get_penerbit']);

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $sktm = $sktm->whereRaw("year(created_at) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $sktm = $sktm->whereRaw("month(created_at) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $sktm = $sktm->orWhere('penduduk_id', "like", "%" . request('q'). "%")->orWhere('keperluan', "like", "%" . request('q'). "%")->orWhere('penerbit_id', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }

        $sktm_download = $sktm->get();
        $sktm = $sktm->paginate(15);
    	
    	return view('sktm.show_all', compact('sktm', 'search_term', 'tahun_choose', 'bulan_choose', 'sktm_download'));
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
        $pdf->loadView('sktm.pdf', compact('surat', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function show($id) {
    	$sktm = SuratKeteranganTidakMampu::with(['get_penduduk', 'get_penerbit'])->find($id);
    	return view('sktm.show', compact('sktm'));
    }

    public function print($id) {
    	$surat = SuratKeteranganTidakMampu::with(['get_penduduk', 'get_penerbit'])->find($id);
        $penduduk = Penduduk::with(['get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);

    	$pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('sktm.print', compact('surat', 'penduduk'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function edit($id) {
    	$penerbit = Penerbit::all();
    	$sktm = SuratKeteranganTidakMampu::with(['get_penduduk', 'get_penerbit'])->find($id);
    	return view('sktm.edit', compact('sktm', 'penerbit'));
    }

    public function store_edit(SuratKeteranganTidakMampu $sktm) {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'keperluan' => 'required',
    		'penerbit_id' => 'required'
    	]);

    	$sktm->keperluan = strtoupper(request('keperluan'));
    	$sktm->penerbit_id = strtoupper(request('penerbit_id'));
    	$sktm->save();

    	return redirect("/sktm/$sktm->id");
    }

    public function delete(SuratKeteranganTidakMampu $sktm) {
    	$sktm->delete();
    	return redirect('/sktm');
    }

    public function stat_sktm_tahun(Request $request) {
    	$data = [];
    	$i = [0,0,0,0,0,0,0,0,0,0,0,0];

    	if ($request->has('tahun')) {
    		$count_month = SuratKeteranganTidakMampu::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();	
    	}
    	else {
    		$now = Carbon::now();
    		$count_month = SuratKeteranganTidakMampu::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
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

    public function stat_sktm_bulan(Request $request) {
    	$data = [];
    	$i = [0,0,0,0];

    	if ($request->has('bulan')) {
    		$count_week = SuratKeteranganTidakMampu::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
    	}
    	else {
    		$now = Carbon::now();
    		$count_week = SuratKeteranganTidakMampu::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
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
