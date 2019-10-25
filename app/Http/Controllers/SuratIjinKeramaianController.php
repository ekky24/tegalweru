<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Penerbit;
use App\SuratIjinKeramaian;
use Carbon\Carbon;
use DB;
use App\Penduduk;

class SuratIjinKeramaianController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}

	public function insert() {
    	$penerbit = Penerbit::all();

    	return view('sik.insert', compact('penerbit'));
    }

    public function store() {
    	$this->validate(request(), [
    		'nik' => 'required',
            'nama_acara' => 'required',
            'tgl_acara' => 'required',
            'jam_acara' => 'required',
    		'tempat_acara' => 'required',
            'hiburan' => 'required',
            'jumlah_undangan' => 'nullable',
    		'jenis_surat' => 'required',
            'dari_pengantar' => 'nullable',
            'tgl_pengantar' => 'nullable',
    		'penerbit_id' => 'required',
    	]);

        if (Penduduk::find(request('nik')) == null) {
            return back()->withErrors([
                'message' => 'NIK yang anda masukkan salah.'
            ]);
        }

    	$cek = SuratIjinKeramaian::latest()->first();
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
    	$nomor_fix = "301/" . $nomor_sesudah . "/35.07.22.2003/" . $tahun;

    	$tgl_acara = request('tgl_acara');
    	$waktu_acara = date('Y-m-d', strtotime("$tgl_acara"));

    	$sik = SuratIjinKeramaian::create([
    		'nomor' => $nomor_fix,
    		'penduduk_id' => request('nik'),
            'nama_acara' => strtoupper(request('nama_acara')),
            'tgl_acara' => $waktu_acara,
            'jam_acara' => strtoupper(request('jam_acara')),
            'tempat_acara' => strtoupper(request('tempat_acara')),
            'hiburan' => strtoupper(request('hiburan')),
            'jenis_surat' => request('jenis_surat'),
    		'penerbit_id' => request('penerbit_id')
    	]);

    	if(request('jumlah_undangan') != null) {
    		$sik->jumlah_undangan = strtoupper(request('jumlah_undangan'));
    		$sik->save();
    	}
        if(request('dari_pengantar') != null) {
            $sik->dari_pengantar = strtoupper(request('dari_pengantar'));
            $sik->save();
        }
        if(request('tgl_pengantar') != null) {
            $sik->tgl_pengantar = strtoupper(request('tgl_pengantar'));
            $sik->save();
        }

    	return redirect("/sik/$sik->id");
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$sik = SuratIjinKeramaian::with(['get_penduduk', 'get_penerbit']);

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $sik = $sik->whereRaw("year(created_at) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $sik = $sik->whereRaw("month(created_at) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $sik = $sik->orWhere('penduduk_id', "like", "%" . request('q'). "%")->orWhere('nama_acara', "like", "%" . request('q'). "%")->orWhere('penerbit_id', "like", "%" . request('q'). "%")->orWhere('nomor', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }
        if ($request->has('page')) {
            $page_choose = (int) request('page');
        }
        else {
            $page_choose = 1;
        }

        $sik_download = $sik->get();
        $sik = $sik->paginate(15, ['*'], 'page', $page_choose);
    	
    	return view('sik.show_all', compact('sik', 'search_term', 'tahun_choose', 'bulan_choose', 'sik_download'));
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
        $pdf->loadView('sik.pdf', compact('surat', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function show($id) {
    	$sik = SuratIjinKeramaian::with(['get_penduduk', 'get_penerbit'])->find($id);
    	return view('sik.show', compact('sik'));
    }

    public function edit($id) {
    	$penerbit = Penerbit::all();
    	$sik = SuratIjinKeramaian::with(['get_penduduk', 'get_penerbit'])->find($id);
    	return view('sik.edit', compact('sik', 'penerbit'));
    }

    public function store_edit(SuratIjinKeramaian $sik) {
    	$this->validate(request(), [
    		'nik' => 'required',
            'nama_acara' => 'required',
            'tgl_acara' => 'required',
            'jam_acara' => 'required',
            'tempat_acara' => 'required',
            'hiburan' => 'required',
            'jumlah_undangan' => 'nullable',
            'jenis_surat' => 'required',
            'penerbit_id' => 'required'
    	]);

    	$tgl_acara = request('tgl_acara');
    	$waktu_acara = date('Y-m-d', strtotime("$tgl_acara"));

        $sik->nama_acara = strtoupper(request('nama_acara'));
        $sik->tgl_acara = $waktu_acara;
        $sik->jam_acara = strtoupper(request('jam_acara'));
        $sik->tempat_acara = strtoupper(request('tempat_acara'));
        $sik->hiburan = strtoupper(request('hiburan'));
        $sik->jenis_surat = request('jenis_surat');
        $sik->penerbit_id = request('penerbit_id');
        $sik->jumlah_undangan = strtoupper(request('jumlah_undangan'));
        $sik->dari_pengantar = strtoupper(request('dari_pengantar'));
        $sik->tgl_pengantar = strtoupper(request('tgl_pengantar'));

    	$sik->save();

    	return redirect("/sik/$sik->id");
    }

    public function delete(SuratIjinKeramaian $sik) {
    	$sik->delete();
    	return redirect('/sik');
    }

    public function print($id) {
    	$surat = SuratIjinKeramaian::with(['get_penduduk', 'get_penerbit'])->find($id);
        $penerbit = Penerbit::where('jabatan', 'KEPALA DESA')->first();
        $penduduk = Penduduk::with(['get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);

    	$pdf = App::make('dompdf.wrapper');

        if($surat->jenis_surat == 'sound_system') {
            $pdf->loadView('sik.print_sound_system', compact('surat', 'penduduk', 'penerbit'));
        }
        elseif($surat->jenis_surat == 'dengan_camat') {
            $pdf->loadView('sik.print_dengan_camat', compact('surat', 'penduduk', 'penerbit'));
        }
        elseif($surat->jenis_surat == 'tanpa_camat') {
            $pdf->loadView('sik.print_tanpa_camat', compact('surat', 'penduduk', 'penerbit'));
        }

        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function stat_sik_tahun(Request $request) {
        $data = [];
        $i = [0,0,0,0,0,0,0,0,0,0,0,0];

        if ($request->has('tahun')) {
            $count_month = SuratIjinKeramaian::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();    
        }
        else {
            $now = Carbon::now();
            $count_month = SuratIjinKeramaian::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
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

    public function stat_sik_bulan(Request $request) {
        $data = [];
        $i = [0,0,0,0];

        if ($request->has('bulan')) {
            $count_week = SuratIjinKeramaian::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
        }
        else {
            $now = Carbon::now();
            $count_week = SuratIjinKeramaian::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
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
