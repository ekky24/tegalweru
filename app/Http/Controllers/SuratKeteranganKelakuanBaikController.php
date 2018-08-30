<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Penerbit;
use App\SuratKeteranganKelakuanBaik;
use Carbon\Carbon;
use DB;
use App\Penduduk;

class SuratKeteranganKelakuanBaikController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}

	public function insert() {
    	$penerbit = Penerbit::all();

    	return view('skkb.insert', compact('penerbit'));
    }

    public function store() {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'nama_ayah' => 'required',
    		'nama_ibu' => 'required',
    		'tempat_lahir_ayah' => 'required',
    		'tempat_lahir_ibu' => 'required',
    		'tgl_lahir_ayah' => 'required',
    		'tgl_lahir_ibu' => 'required',
    		'agama_ayah' => 'required',
    		'agama_ibu' => 'required',
    		'pekerjaan_ayah' => 'required',
    		'pekerjaan_ibu' => 'required',
    		'alamat_ayah' => 'required',
    		'alamat_ibu' => 'required',
    		'keperluan' => 'required',
    		'penerbit_id' => 'required'
    	]);

        if (Penduduk::find(request('nik')) == null) {
            return back()->withErrors([
                'message' => 'NIK yang anda masukkan salah.'
            ]);
        }

    	$cek = SuratKeteranganKelakuanBaik::latest()->first();
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
    	$nomor_fix = "721/" . $nomor_sesudah . "/421.633.006/" . $tahun;

    	$skkb = SuratKeteranganKelakuanBaik::create([
    		'nomor' => $nomor_fix,
    		'penduduk_id' => request('nik'),
    		'nama_ayah' => strtoupper(request('nama_ayah')),
    		'nama_ibu' => strtoupper(request('nama_ibu')),
    		'tempat_lahir_ayah' => strtoupper(request('tempat_lahir_ayah')),
    		'tempat_lahir_ibu' => strtoupper(request('tempat_lahir_ibu')),
    		'tgl_lahir_ayah' => request('tgl_lahir_ayah'),
    		'tgl_lahir_ibu' => request('tgl_lahir_ibu'),
    		'agama_ayah' => strtoupper(request('agama_ayah')),
    		'agama_ibu' => strtoupper(request('agama_ibu')),
    		'pekerjaan_ayah' => strtoupper(request('pekerjaan_ayah')),
    		'pekerjaan_ibu' => strtoupper(request('pekerjaan_ibu')),
    		'alamat_ayah' => strtoupper(request('alamat_ayah')),
    		'alamat_ibu' => strtoupper(request('alamat_ibu')),
    		'keperluan' => strtoupper(request('keperluan')),
    		'penerbit_id' => request('penerbit_id')
    	]);

    	return redirect("/skkb/$skkb->id");
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$skkb = SuratKeteranganKelakuanBaik::with(['get_penduduk', 'get_penerbit']);

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $skkb = $skkb->whereRaw("year(created_at) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $skkb = $skkb->whereRaw("month(created_at) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $skkb = $skkb->orWhere('penduduk_id', "like", "%" . request('q'). "%")->orWhere('keperluan', "like", "%" . request('q'). "%")->orWhere('penerbit_id', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }

        $skkb_download = $skkb->get();
        $skkb = $skkb->paginate(15);
    	
    	return view('skkb.show_all', compact('skkb', 'search_term', 'tahun_choose', 'bulan_choose', 'skkb_download'));
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
        $pdf->loadView('skkb.pdf', compact('surat', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function show($id) {
    	$skkb = SuratKeteranganKelakuanBaik::with(['get_penduduk', 'get_penerbit'])->find($id);
    	return view('skkb.show', compact('skkb'));
    }

    public function edit($id) {
    	$penerbit = Penerbit::all();
    	$skkb = SuratKeteranganKelakuanBaik::with(['get_penduduk', 'get_penerbit'])->find($id);
    	return view('skkb.edit', compact('skkb', 'penerbit'));
    }

    public function store_edit(SuratKeteranganKelakuanBaik $skkb) {
    	$this->validate(request(), [
    		'nik' => 'required',
    		'nama_ayah' => 'required',
    		'nama_ibu' => 'required',
    		'tempat_lahir_ayah' => 'required',
    		'tempat_lahir_ibu' => 'required',
    		'tgl_lahir_ayah' => 'required',
    		'tgl_lahir_ibu' => 'required',
    		'agama_ayah' => 'required',
    		'agama_ibu' => 'required',
    		'pekerjaan_ayah' => 'required',
    		'pekerjaan_ibu' => 'required',
    		'alamat_ayah' => 'required',
    		'alamat_ibu' => 'required',
    		'keperluan' => 'required',
    		'penerbit_id' => 'required'
    	]);

    	$skkb->nama_ayah = strtoupper(request('nama_ayah'));
    	$skkb->nama_ibu = strtoupper(request('nama_ibu'));
    	$skkb->tempat_lahir_ayah = strtoupper(request('tempat_lahir_ayah'));
    	$skkb->tempat_lahir_ibu = strtoupper(request('tempat_lahir_ibu'));
    	$skkb->tgl_lahir_ayah = request('tgl_lahir_ayah');
    	$skkb->tgl_lahir_ibu = request('tgl_lahir_ibu');
    	$skkb->agama_ayah = strtoupper(request('agama_ayah'));
    	$skkb->agama_ibu = strtoupper(request('agama_ibu'));
    	$skkb->pekerjaan_ayah = strtoupper(request('pekerjaan_ayah'));
    	$skkb->pekerjaan_ibu = strtoupper(request('pekerjaan_ibu'));
    	$skkb->alamat_ayah = strtoupper(request('alamat_ayah'));
    	$skkb->alamat_ibu = strtoupper(request('alamat_ibu'));
    	$skkb->keperluan = strtoupper(request('keperluan'));
    	$skkb->penerbit_id = strtoupper(request('penerbit_id'));
    	$skkb->save();

    	return redirect("/skkb/$skkb->id");
    }

    public function delete(SuratKeteranganKelakuanBaik $skkb) {
    	$skkb->delete();
    	return redirect('/skkb');
    }

    public function print($id) {
    	$surat = SuratKeteranganKelakuanBaik::with(['get_penduduk', 'get_penerbit'])->find($id);
        $penduduk = Penduduk::with(['get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);

    	$pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('skkb.print', compact('surat', 'penduduk'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function stat_skkb_tahun(Request $request) {
    	$data = [];
    	$i = [0,0,0,0,0,0,0,0,0,0,0,0];

    	if ($request->has('tahun')) {
    		$count_month = SuratKeteranganKelakuanBaik::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();	
    	}
    	else {
    		$now = Carbon::now();
    		$count_month = SuratKeteranganKelakuanBaik::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
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

    public function stat_skkb_bulan(Request $request) {
    	$data = [];
    	$i = [0,0,0,0];

    	if ($request->has('bulan')) {
    		$count_week = SuratKeteranganKelakuanBaik::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
    	}
    	else {
    		$now = Carbon::now();
    		$count_week = SuratKeteranganKelakuanBaik::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
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
