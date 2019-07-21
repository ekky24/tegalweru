<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Kematian;
use App\Penduduk;
use App\Penerbit;
use Carbon\Carbon;
use DB;

class KematianController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function insert() {
    	$penerbit = Penerbit::all();
        return view('kematian.insert', compact('penerbit'));
    }

    public function store() {
    	$this->validate(request(), [
            'nik' => 'required',
    		'tempat_kematian' => 'required',
    		'tgl_kematian' => 'required',
    		'jam_kematian' => 'required',
    		'penyebab_kematian' => 'required',
            'nik_pelapor' => 'required',
            'hubungan_pelapor' => 'required',
            'penerbit_id' => 'required',
    	]);

        if (Penduduk::find(request('nik')) == null) {
            return back()->withErrors([
                'message' => 'NIK yang anda masukkan salah.'
            ]);
        }

        $cek = Kematian::latest()->first();
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
                $get_last = substr($nomor_temp, 7);
                $pos = strpos($get_last, '/');
                $nomor_sebelum = substr($get_last, 0, $pos);
            }
        }

        $nomor_sesudah = $nomor_sebelum + 1;
        $nomor_fix = "472.12/" . $nomor_sesudah . "/35.07.22.2003/" . $tahun;

    	$tgl_kematian = request('tgl_kematian');
    	$waktu_kematian = date('Y-m-d H:i:s', strtotime("$tgl_kematian"));

    	Kematian::create([
    		'penduduk_id' => request('nik'),
            'nomor' => $nomor_fix,
    		'tempat_kematian' => strtoupper(request('tempat_kematian')),
    		'tgl_kematian' => $waktu_kematian,
            'jam_kematian' => strtoupper(request('jam_kematian')),
    		'penyebab_kematian' => strtoupper(request('penyebab_kematian')),
            'nik_pelapor' => request('nik_pelapor'),
            'hubungan_pelapor' => strtoupper(request('hubungan_pelapor')),
            'penerbit_id' => request('penerbit_id'),
    	]);

    	$penduduk = Penduduk::find(request('nik'));
    	$penduduk->status = "1";
    	$penduduk->save();

    	return redirect("kematian/$kematian->penduduk_id");
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$kematian = Kematian::with('get_penduduk');

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $kematian = $kematian->whereRaw("year(tgl_kematian) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $kematian = $kematian->whereRaw("month(tgl_kematian) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $kematian = $kematian->orWhere('penduduk_id', "like", "%" . request('q'). "%")->orWhere('tempat_kematian', "like", "%" . request('q'). "%")->orWhere('tgl_kematian', "like", "%" . request('q'). "%")->orWhere('penyebab_kematian', "like", "%" . request('q'). "%")->orWhere('created_at', "like", "%" . request('q'). "%")->orWhere('nomor', "like", "%" . request('q'). "%");
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
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function edit(Kematian $kematian) {
        $penerbit = Penerbit::all();
    	$kematian->get_penduduk;
        $pelapor = Penduduk::with('get_kk')->where('id', $kematian->nik_pelapor)->first();
    	return view('kematian.edit', compact('kematian', 'pelapor', 'penerbit'));
    }

    public function store_edit(Kematian $kematian) {
    	$this->validate(request(), [
            'tempat_kematian' => 'required',
            'tgl_kematian' => 'required',
            'jam_kematian' => 'required',
            'penyebab_kematian' => 'required',
            'nik_pelapor' => 'required',
            'hubungan_pelapor' => 'required',
            'penerbit_id' => 'required',
    	]);

    	$tgl_kematian = request('tgl_kematian');
    	$waktu_kematian = date('Y-m-d', strtotime("$tgl_kematian"));

    	$kematian->tempat_kematian = strtoupper(request('tempat_kematian'));
    	$kematian->tgl_kematian = $tgl_kematian;
        $kematian->jam_kematian = strtoupper(request('jam_kematian'));
        $kematian->penyebab_kematian = strtoupper(request('penyebab_kematian'));
        $kematian->nik_pelapor = strtoupper(request('nik_pelapor'));
    	$kematian->hubungan_pelapor = strtoupper(request('hubungan_pelapor'));
        $kematian->penerbit_id = strtoupper(request('penerbit_id'));
    	$kematian->save();

    	return redirect("kematian/$kematian->penduduk_id");
    }

    public function show($id) {
        $kematian = Kematian::with(['get_penduduk', 'get_penerbit'])->find($id);
        $pelapor = Penduduk::with('get_kk')->where('id', $kematian->nik_pelapor)->first();
        $penerbit = Penerbit::all();
        return view('kematian.show', compact('kematian', 'pelapor', 'penerbit'));
    }

    public function print($id) {
        $surat = Kematian::with(['get_penduduk', 'get_penerbit'])->find($id);
        $pelapor = Penduduk::with('get_kk')->where('id', $surat->nik_pelapor)->first();
        $penerbit = Penerbit::where('jabatan', 'KEPALA DESA')->first();
        $penduduk = Penduduk::with(['get_agama', 'get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('kematian.print', compact('surat', 'penerbit', 'pelapor', 'penduduk'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function delete(Kematian $kematian) {
    	$penduduk = $kematian->get_penduduk;
    	$penduduk->status = NULL;
    	$penduduk->save();

    	$kematian->delete();
    	return redirect('/kematian');
    }

    public function stat_kematian_tahun(Request $request) {
        $data = [];
        $i = [0,0,0,0,0,0,0,0,0,0,0,0];

        if ($request->has('tahun')) {
            $count_month = Kematian::selectRaw('count(penduduk_id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();    
        }
        else {
            $now = Carbon::now();
            $count_month = Kematian::selectRaw('count(penduduk_id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
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

    public function stat_kematian_bulan(Request $request) {
        $data = [];
        $i = [0,0,0,0];

        if ($request->has('bulan')) {
            $count_week = Kematian::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`penduduk_id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
        }
        else {
            $now = Carbon::now();
            $count_week = Kematian::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`penduduk_id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
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
