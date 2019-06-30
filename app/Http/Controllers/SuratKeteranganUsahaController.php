<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penerbit;
use App\SuratKeteranganUsaha;
use Carbon\Carbon;
use App;
use DB;
use App\Penduduk;

class SuratKeteranganUsahaController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}

    public function insert() {
    	$penerbit = Penerbit::all();
    	return view('sku.insert', compact('penerbit'));
    }

    public function insert_bri() {
        $penerbit = Penerbit::all();
        return view('sku.insert_bri', compact('penerbit'));
    }

    public function insert_jatim_mandiri() {
        $penerbit = Penerbit::all();
        return view('sku.insert_jatim_mandiri', compact('penerbit'));
    }

    public function insert_domisili_usaha() {
        $penerbit = Penerbit::all();
        return view('sku.insert_domisili_usaha', compact('penerbit'));
    }

    public function store(Request $request) {
        $this->validate(request(), [
            'nik' => 'required',
            'nama_usaha' => 'required',
            'tahun_pendirian_usaha' => 'nullable',
            'bidang_usaha' => 'nullable',
            'alamat_usaha' => 'nullable',
            'keperluan' => 'nullable',
            'dari_pengantar' => 'nullable',
            'tgl_pengantar' => 'nullable',
            'penerbit_id' => 'required',
            'jenis_surat' => 'required',
            'sendiri_sawah' => 'nullable',
            'sendiri_tegal' => 'nullable',
            'sewa_sawah' => 'nullable',
            'sewa_tegal' => 'nullable',
        ]);

        if (Penduduk::find(request('nik')) == null) {
            if(request('jenis_surat') != 'domisili_usaha') {
                return back()->withErrors([
                    'message' => 'NIK yang anda masukkan salah.'
                ]);
            }
        }

        $cek = SuratKeteranganUsaha::latest()->first();
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
        $nomor_fix = "517/" . $nomor_sesudah . "/35.07.22.2003/" . $tahun;

        if(request('jenis_surat') == 'biasa') {
            $sku = SuratKeteranganUsaha::create([
                'nomor' => $nomor_fix,
                'penduduk_id' => request('nik'),
                'nama_usaha' => strtoupper(request('nama_usaha')),
                'alamat_usaha' => strtoupper(request('alamat_usaha')),
                'keperluan' => strtoupper(request('keperluan')),
                'dari_pengantar' => strtoupper(request('dari_pengantar')),
                'tgl_pengantar' => strtoupper(request('tgl_pengantar')),
                'penerbit_id' => request('penerbit_id'),
                'jenis_surat' => request('jenis_surat'),
            ]);
        }
        elseif(request('jenis_surat') == 'bri') {
            $sku = SuratKeteranganUsaha::create([
                'nomor' => $nomor_fix,
                'penduduk_id' => request('nik'),
                'nama_usaha' => strtoupper(request('nama_usaha')),
                'penerbit_id' => request('penerbit_id'),
                'jenis_surat' => request('jenis_surat'),
            ]);

            if ($request->has('sendiri_sawah')) {
                $sku->sendiri_sawah = request('sendiri_sawah');
            }
            if ($request->has('sendiri_tegal')) {
                $sku->sendiri_tegal = request('sendiri_tegal');
            }  
            if ($request->has('sewa_sawah')) {
                $sku->sewa_sawah = request('sewa_sawah');
            }  
            if ($request->has('sewa_tegal')) {
                $sku->sewa_tegal = request('sewa_tegal');
            }
        }
        elseif(request('jenis_surat') == 'jatim_mandiri') {
            $sku = SuratKeteranganUsaha::create([
                'nomor' => $nomor_fix,
                'penduduk_id' => request('nik'),
                'nama_usaha' => strtoupper(request('nama_usaha')),
                'alamat_usaha' => strtoupper(request('alamat_usaha')),
                'keperluan' => strtoupper(request('keperluan')),
                'penerbit_id' => request('penerbit_id'),
                'jenis_surat' => request('jenis_surat'),
            ]);
        }

        elseif(request('jenis_surat') == 'domisili_usaha') {
            $sku = SuratKeteranganUsaha::create([
                'nomor' => $nomor_fix,
                'penduduk_id' => request('nik'),
                'nama_pimpinan' => strtoupper(request('nama_pimpinan')),
                'alamat_pimpinan' => strtoupper(request('alamat_pimpinan')),
                'nama_usaha' => strtoupper(request('nama_usaha')),
                'tahun_pendirian_usaha' => strtoupper(request('tahun_pendirian_usaha')),
                'bidang_usaha' => strtoupper(request('bidang_usaha')),
                'alamat_usaha' => strtoupper(request('alamat_usaha')),
                'dari_pengantar' => strtoupper(request('dari_pengantar')),
                'tgl_pengantar' => strtoupper(request('tgl_pengantar')),
                'penerbit_id' => request('penerbit_id'),
                'jenis_surat' => request('jenis_surat'),
            ]);
        }
        
        $sku->save();

        return redirect("/sku/$sku->id");
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$sku = SuratKeteranganUsaha::with(['get_penduduk', 'get_penerbit']);

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $sku = $sku->whereRaw("year(created_at) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $sku = $sku->whereRaw("month(created_at) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $sku = $sku->orWhere('penduduk_id', "like", "%" . request('q'). "%")->orWhere('keperluan', "like", "%" . request('q'). "%")->orWhere('penerbit_id', "like", "%" . request('q'). "%")->orWhere('nomor', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }

        $sku_download = $sku->get();
        $sku = $sku->paginate(15);
    	
    	return view('sku.show_all', compact('sku', 'search_term', 'tahun_choose', 'bulan_choose', 'sku_download'));
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
        $pdf->loadView('sku.pdf', compact('surat', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function print($id, $jenis_surat) {
    	$surat = SuratKeteranganUsaha::with(['get_penduduk', 'get_penerbit'])->find($id);
        $penerbit = Penerbit::where('jabatan', 'KEPALA DESA')->first();

    	$pdf = App::make('dompdf.wrapper');
        if($jenis_surat == 'biasa') {
            $penduduk = Penduduk::with(['get_agama', 'get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);
            $pdf->loadView('sku.print', compact('surat', 'penduduk', 'penerbit'));
        }
        elseif($jenis_surat == 'bri') {
            $penduduk = Penduduk::with(['get_agama', 'get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);
            $pdf->loadView('sku.print_bri', compact('surat', 'penduduk', 'penerbit'));
        }
        elseif($jenis_surat == 'jatim_mandiri') {
            $penduduk = Penduduk::with(['get_agama', 'get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);
            $pdf->loadView('sku.print_jatim_mandiri', compact('surat', 'penduduk', 'penerbit'));
        }
        elseif($jenis_surat == 'domisili_usaha') {
            $pdf->loadView('sku.print_domisili_usaha', compact('surat', 'penerbit'));
        }

        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function store_edit(SuratKeteranganUsaha $sku, Request $request) {
    	$this->validate(request(), [
    		'penduduk_id' => 'nullable',
            'nama_usaha' => 'required',
            'tahun_pendirian_usaha' => 'nullable',
            'bidang_usaha' => 'nullable',
            'alamat_usaha' => 'nullable',
            'keperluan' => 'nullable',
            'dari_pengantar' => 'nullable',
            'tgl_pengantar' => 'nullable',
            'penerbit_id' => 'required',
            'jenis_surat' => 'required',
            'sendiri_sawah' => 'nullable',
            'sendiri_tegal' => 'nullable',
            'sewa_sawah' => 'nullable',
            'sewa_tegal' => 'nullable',
    	]);

    	if(request('jenis_surat') == 'biasa') {
            $sku->nama_usaha = strtoupper(request('nama_usaha'));
            $sku->alamat_usaha = strtoupper(request('alamat_usaha'));
            $sku->keperluan = strtoupper(request('keperluan'));
            $sku->dari_pengantar = strtoupper(request('dari_pengantar'));
            $sku->tgl_pengantar = strtoupper(request('tgl_pengantar'));
            $sku->penerbit_id = strtoupper(request('penerbit_id'));
        }
        elseif(request('jenis_surat') == 'bri') {
            $sku->nama_usaha = strtoupper(request('nama_usaha'));
            $sku->penerbit_id = strtoupper(request('penerbit_id'));

            if ($request->has('sendiri_sawah')) {
                $sku->sendiri_sawah = request('sendiri_sawah');
            }
            if ($request->has('sendiri_tegal')) {
                $sku->sendiri_tegal = request('sendiri_tegal');
            }  
            if ($request->has('sewa_sawah')) {
                $sku->sewa_sawah = request('sewa_sawah');
            }  
            if ($request->has('sewa_tegal')) {
                $sku->sewa_tegal = request('sewa_tegal');
            }
        }
        elseif(request('jenis_surat') == 'jatim_mandiri') {
            $sku->nama_usaha = strtoupper(request('nama_usaha'));
            $sku->alamat_usaha = strtoupper(request('alamat_usaha'));
            $sku->keperluan = strtoupper(request('keperluan'));
            $sku->penerbit_id = strtoupper(request('penerbit_id'));
        }
        elseif(request('jenis_surat') == 'domisili_usaha') {
            $sku->penduduk_id = strtoupper(request('penduduk_id'));
            $sku->nama_pimpinan = strtoupper(request('nama_pimpinan'));
            $sku->alamat_pimpinan = strtoupper(request('alamat_pimpinan'));
            $sku->nama_usaha = strtoupper(request('nama_usaha'));
            $sku->tahun_pendirian_usaha = strtoupper(request('tahun_pendirian_usaha'));
            $sku->bidang_usaha = strtoupper(request('bidang_usaha'));
            $sku->alamat_usaha = strtoupper(request('alamat_usaha'));
            $sku->dari_pengantar = strtoupper(request('dari_pengantar'));
            $sku->tgl_pengantar = strtoupper(request('tgl_pengantar'));
            $sku->penerbit_id = strtoupper(request('penerbit_id'));
        }
        
        $sku->save();
    	return redirect("/sku/$sku->id");
    }

    public function show($id) {
    	$sku = SuratKeteranganUsaha::with(['get_penduduk', 'get_penerbit'])->find($id);
        if($sku->jenis_surat == 'domisili_usaha') {
            return view('sku.show_domisili_usaha', compact('sku'));
        }
        else {
            return view('sku.show', compact('sku'));
        }
    }

    public function edit($id, $jenis_surat) {
    	$penerbit = Penerbit::all();
    	$sku = SuratKeteranganUsaha::with(['get_penduduk', 'get_penerbit'])->find($id);

        if($jenis_surat == 'biasa') {
            $penduduk = Penduduk::with(['get_agama', 'get_tempat_lahir'])->find($sku->get_penduduk->id);
            return view('sku.edit', compact('sku', 'penerbit', 'penduduk'));
        }
        elseif($jenis_surat == 'bri') {
            $penduduk = Penduduk::with(['get_agama', 'get_tempat_lahir'])->find($sku->get_penduduk->id);
            return view('sku.edit_bri', compact('sku', 'penerbit', 'penduduk'));
        }
        elseif($jenis_surat == 'jatim_mandiri') {
            $penduduk = Penduduk::with(['get_agama', 'get_tempat_lahir'])->find($sku->get_penduduk->id);
            return view('sku.edit_jatim_mandiri', compact('sku', 'penerbit', 'penduduk'));
        }
        elseif($jenis_surat == 'domisili_usaha') {
            return view('sku.edit_domisili_usaha', compact('sku', 'penerbit'));
        }
    }

    public function delete(SuratKeteranganUsaha $sku) {
    	$sku->delete();
    	return redirect('/sku');
    }

    public function stat_sku_tahun(Request $request) {
    	$data = [];
    	$i = [0,0,0,0,0,0,0,0,0,0,0,0];

    	if ($request->has('tahun')) {
    		$count_month = SuratKeteranganUsaha::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();	
    	}
    	else {
    		$now = Carbon::now();
    		$count_month = SuratKeteranganUsaha::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
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

    public function stat_sku_bulan(Request $request) {
    	$data = [];
    	$i = [0,0,0,0];

    	if ($request->has('bulan')) {
    		$count_week = SuratKeteranganUsaha::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
    	}
    	else {
    		$now = Carbon::now();
    		$count_week = SuratKeteranganUsaha::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
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
