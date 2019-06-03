<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Penerbit;
use App\SuratDomisili;
use Carbon\Carbon;
use DB;
use App\Penduduk;
use App\Kelahiran;

class SuratDomisiliController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}

	public function insert() {
    	$penerbit = Penerbit::all();

    	return view('skdom.insert', compact('penerbit'));
    }

    public function store() {
    	$this->validate(request(), [
    		'nik' => 'required',
            'dari_pengantar' => 'required',
            'tgl_pengantar' => 'required',
            'penerbit_id' => 'required',
    	]);

        if (Penduduk::find(request('nik')) == null) {
            if(request('jenis_surat') != 'domisili_usaha') {
                return back()->withErrors([
                    'message' => 'NIK yang anda masukkan salah.'
                ]);
            }
        }

        $cek = SuratDomisili::latest()->first();
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
        $nomor_fix = "471/" . $nomor_sesudah . "/35.07.22.2003/" . $tahun;

    	$skdom = SuratDomisili::create([
    		'nomor' => $nomor_fix,
            'penduduk_id' => request('nik'),
            'dari_pengantar' => strtoupper(request('dari_pengantar')),
            'tgl_pengantar' => strtoupper(request('tgl_pengantar')),
            'penerbit_id' => request('penerbit_id'),
    	]);

    	return redirect("/skdom/$skdom->id");
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$skdom = SuratDomisili::with(['get_penduduk', 'get_penerbit']);

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $skdom = $skdom->whereRaw("year(created_at) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $skdom = $skdom->whereRaw("month(created_at) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $skdom = $skdom->orWhere('nik_ibu', "like", "%" . request('q'). "%")->orWhere('penerbit_id', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }

        $skdom_download = $skdom->get();
        $skdom = $skdom->paginate(15);
    	
    	return view('skdom.show_all', compact('skdom', 'search_term', 'tahun_choose', 'bulan_choose', 'skdom_download'));
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
        $pdf->loadView('skdom.pdf', compact('surat', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function show($id) {
    	$skdom = SuratDomisili::with(['get_penerbit'])->find($id);
        $penduduk = Penduduk::with(['get_kk'])->find($skdom->penduduk_id);
 
    	return view('skdom.show', compact('skdom', 'penduduk'));
    }

    public function edit($id) {
    	$penerbit = Penerbit::all();
    	$skdom = SuratDomisili::with(['get_penduduk', 'get_penerbit'])->find($id);
    	$penduduk = Penduduk::with(['get_agama', 'get_tempat_lahir'])->find($skdom->get_penduduk->id);
    	return view('skdom.edit', compact('skdom', 'penerbit', 'penduduk'));
    }

    public function store_edit(SuratDomisili $skdom) {
    	$this->validate(request(), [
    		'nik' => 'required',
            'dari_pengantar' => 'required',
            'tgl_pengantar' => 'required',
            'penerbit_id' => 'required',
    	]);

        $skdom->dari_pengantar = strtoupper(request('dari_pengantar'));
        $skdom->tgl_pengantar = strtoupper(request('tgl_pengantar'));
    	$skdom->penerbit_id = strtoupper(request('penerbit_id'));
    	$skdom->save();

    	return redirect("/skdom/$skdom->id");
    }

    public function delete(SuratDomisili $skdom) {
    	$skdom->delete();
    	return redirect('/skdom');
    }

    public function print($id) {
    	$surat = SuratDomisili::with(['get_penduduk', 'get_penerbit'])->find($id);
        $penduduk = Penduduk::with(['get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);
        $penerbit = Penerbit::where('jabatan', 'KEPALA DESA')->first();

    	$pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('skdom.print', compact('surat', 'penduduk', 'penerbit'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function stat_skdom_tahun(Request $request) {
        $data = [];
        $i = [0,0,0,0,0,0,0,0,0,0,0,0];

        if ($request->has('tahun')) {
            $count_month = SuratDomisili::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();    
        }
        else {
            $now = Carbon::now();
            $count_month = SuratDomisili::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
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

    public function stat_skdom_bulan(Request $request) {
        $data = [];
        $i = [0,0,0,0];

        if ($request->has('bulan')) {
            $count_week = SuratDomisili::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
        }
        else {
            $now = Carbon::now();
            $count_week = SuratDomisili::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
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