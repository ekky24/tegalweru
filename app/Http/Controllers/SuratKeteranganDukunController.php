<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Penerbit;
use App\SuratKeteranganDukun;
use Carbon\Carbon;
use DB;
use App\Penduduk;
use App\Kelahiran;
use App\Agama;
use App\Pendidikan;
use App\JenisPekerjaan;
use App\StatusNikah;
use App\StatusHubungan;
use App\Kota;

class SuratKeteranganDukunController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}

	public function insert() {
    	$penerbit = Penerbit::all();

    	return view('skd.insert', compact('penerbit'));
    }

    public function store() {
    	$this->validate(request(), [
            'judul_surat' => 'required',
            'nomor_surat' => 'required',
    		'nik_ibu' => 'required',
            'nik_ayah' => 'required',
            'nik_pelapor' => 'required',
            'hubungan_pelapor' => 'required',
    		'tgl_kelahiran' => 'required',
            'jam_kelahiran' => 'required',
            'tempat_kelahiran' => 'required',
    		'jk_anak' => 'required',
            'nama_anak' => 'required',
            'anak_ke' => 'required',
            'penerbit_id' => 'required',
    		'created_at' => 'required',
    	]);

        if (Penduduk::find(request('nik_ibu')) == null or Penduduk::find(request('nik_ayah')) == null or Penduduk::find(request('nik_pelapor')) == null) {
            return back()->withErrors([
                'message' => 'NIK yang anda masukkan salah.'
            ]);
        }

    	$cek = SuratKeteranganDukun::latest()->first();
    	$now = Carbon::now();
    	$tahun = $now->year;
    
    	// if ($cek == null) {
    	// 	$nomor_sebelum = 0;
    	// }
    	// else {
    	// 	$nomor_temp = $cek->nomor;
    	// 	$tahun_temp = substr($nomor_temp, -4);

    	// 	if ($tahun_temp < $tahun) {
    	// 		$nomor_sebelum = 0;
    	// 	}
    	// 	else {
    	// 		$get_last = substr($nomor_temp, 7);
    	// 		$pos = strpos($get_last, '/');
    	// 		$nomor_sebelum = substr($get_last, 0, $pos);
    	// 	}
    	// }

    	// $nomor_sesudah = $nomor_sebelum + 1;
    	// $nomor_fix = "472.11/" . $nomor_sesudah . "/35.07.22.2003/" . $tahun;

    	$tgl_kelahiran = request('tgl_kelahiran');
    	$waktu_kelahiran = date('Y-m-d', strtotime("$tgl_kelahiran"));

    	$skd = SuratKeteranganDukun::create([
    		'judul' => strtoupper(request('judul_surat')),
            'nomor' => strtoupper(request('nomor_surat')),
    		'nik_ibu' => request('nik_ibu'),
            'nik_ayah' => request('nik_ayah'),
            'nik_pelapor' => request('nik_pelapor'),
            'hubungan_pelapor' => strtoupper(request('hubungan_pelapor')),
            'tgl_kelahiran' => Carbon::createFromFormat('d-m-Y', request('tgl_kelahiran')),
            'jam_kelahiran' => request('jam_kelahiran'),
            'tempat_kelahiran' => strtoupper(request('tempat_kelahiran')),
            'jk_anak' => strtoupper(request('jk_anak')),
            'nama_anak' => strtoupper(request('nama_anak')),
            'anak_ke' => strtoupper(request('anak_ke')),
    		'penerbit_id' => request('penerbit_id'),
            'created_at' => Carbon::createFromFormat('d-m-Y', request('created_at')),
    	]);

        Kelahiran::create([
            'nama' => strtoupper(request('nama_anak')),
            'jk' => request('jk_anak'),
            'tempat_lahir' => strtoupper('3573'),
            'tgl_lahir' => Carbon::createFromFormat('d-m-Y', request('tgl_kelahiran')),
            'surat_lahir_id' => $skd->id,
        ]);

    	return redirect("/skd/$skd->id")->with(['msg' => 'Data berhasil disimpan']);
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$skd = SuratKeteranganDukun::with(['get_penduduk_ibu', 'get_penduduk_ayah', 'get_penduduk_pelapor', 'get_penerbit']);

    	if ($request->has('tahun')) {
    		$tahun = request('tahun');
            $skd = $skd->whereRaw("year(created_at) = $tahun");
            $tahun_choose = request('tahun');
        }
        if ($request->has('bulan')) {
    		$bulan = request('bulan');
            $skd = $skd->whereRaw("month(created_at) = $bulan");
            $bulan_choose = request('bulan');
        }
        if ($request->has('q')) {
            $skd = $skd->orWhere('nama_ibu', "like", "%" . request('q'). "%")->orWhere('nama_anak', "like", "%" . request('q'). "%")->orWhere('penerbit_id', "like", "%" . request('q'). "%")->orWhere('nama_ayah', "like", "%" . request('q'). "%")->orWhere('nomor', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }
        if ($request->has('page')) {
            $page_choose = (int) request('page');
        }
        else {
            $page_choose = 1;
        }

        $skd_download = $skd->orderBy('created_at', 'desc')->get();
        $skd = $skd->paginate(15, ['*'], 'page', $page_choose);
    	
    	return view('skd.show_all', compact('skd', 'search_term', 'tahun_choose', 'bulan_choose', 'skd_download'));
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
        $pdf->loadView('skd.pdf', compact('surat', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function show($id) {
    	$skd = SuratKeteranganDukun::with(['get_penerbit', 'get_kelahiran'])->find($id);
        $penduduk_ibu = Penduduk::with(['get_kk'])->find($skd->nik_ibu);
        $penduduk_ayah = Penduduk::with(['get_kk'])->find($skd->nik_ayah);
        $penduduk_pelapor = Penduduk::with(['get_kk'])->find($skd->nik_pelapor);
    	return view('skd.show', compact('skd', 'penduduk_ibu', 'penduduk_ayah', 'penduduk_pelapor'));
    }

    public function edit($id) {
    	$penerbit = Penerbit::all();
    	$skd = SuratKeteranganDukun::with(['get_penduduk_ibu', 'get_penduduk_ayah', 'get_penduduk_pelapor', 'get_penerbit'])->find($id);
    	return view('skd.edit', compact('skd', 'penerbit'));
    }

    public function store_edit(SuratKeteranganDukun $skd) {
    	$this->validate(request(), [
            'judul_surat' => 'required',
            'nomor_surat' => 'required',
    		'nik_ibu' => 'required',
            'nik_ayah' => 'required',
            'nik_pelapor' => 'required',
            'hubungan_pelapor' => 'required',
            'tgl_kelahiran' => 'required',
            'jam_kelahiran' => 'required',
            'tempat_kelahiran' => 'required',
            'jk_anak' => 'required',
            'nama_anak' => 'required',
            'anak_ke' => 'required',
            'penerbit_id' => 'required',
            'created_at' => 'required',
    	]);

    	$tgl_kelahiran = request('tgl_kelahiran');
    	$waktu_kelahiran = date('Y-m-d', strtotime("$tgl_kelahiran"));

        $skd->judul = strtoupper(request('judul_surat'));
        $skd->nomor = strtoupper(request('nomor_surat'));
    	$skd->nik_ibu = strtoupper(request('nik_ibu'));
    	$skd->nik_ayah = strtoupper(request('nik_ayah'));
    	$skd->nik_pelapor = strtoupper(request('nik_pelapor'));
        $skd->hubungan_pelapor = strtoupper(request('hubungan_pelapor'));
        $skd->tgl_kelahiran = strtoupper($waktu_kelahiran);
        $skd->jam_kelahiran = strtoupper(request('jam_kelahiran'));
        $skd->tempat_kelahiran = strtoupper(request('tempat_kelahiran'));
        $skd->jk_anak = strtoupper(request('jk_anak'));
        $skd->nama_anak = strtoupper(request('nama_anak'));
        $skd->anak_ke = strtoupper(request('anak_ke'));
    	$skd->penerbit_id = strtoupper(request('penerbit_id'));
        $skd->created_at = Carbon::createFromFormat('d-m-Y', request('created_at'));
    	$skd->save();

    	return redirect("/skd/$skd->id")->with(['msg' => 'Data berhasil diubah']);
    }

    public function daftar_penduduk($id) {
        $agama = Agama::all();
        $pendidikan = Pendidikan::all();
        $pekerjaan = JenisPekerjaan::all();
        $status_nikah = StatusNikah::all();
        $status_hubungan = StatusHubungan::all();
        $skd = SuratKeteranganDukun::with(['get_penduduk_ibu', 'get_penduduk_ayah', 'get_penduduk_pelapor', 'get_penerbit'])->find($id);
        return view('skd.daftar_penduduk', compact('skd', 'agama', 'pendidikan', 'pekerjaan', 'status_nikah', 'status_hubungan'));
    }

    public function store_daftar_penduduk($id) {
        $this->validate(request(), [
            'nik' => 'required|numeric',
            'nama' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'agama_id' => 'required|numeric',
            'pendidikan_id' => 'required|numeric',
            'jenis_pekerjaan_id' => 'required|numeric',
            'status_nikah_id' => 'required|numeric',
            'status_hubungan_id' => 'required|numeric',
            'kewarganegaraan' => 'required',
            'ayah' => 'required',
            'ibu' => 'required',
            'kk_id' => 'required'
        ]);

        $tempat_lahir = Kota::select('id')->where('nama', "like", "%" . request('tempat_lahir') . "%")->get();

        Penduduk::create([
            'id' => request('nik'),
            'nama' => strtoupper(request('nama')),
            'jk' => request('jk'),
            'alamat_sebelumnya' => '',
            'tempat_lahir' => $tempat_lahir[0]->id,
            'tgl_lahir' => request('tgl_lahir'),
            'agama_id' => request('agama_id'),
            'pendidikan_id' => request('pendidikan_id'),
            'jenis_pekerjaan_id' => request('jenis_pekerjaan_id'),
            'status_nikah_id' => request('status_nikah_id'),
            'status_hubungan_id' => request('status_hubungan_id'),
            'kewarganegaraan' => request('kewarganegaraan'),
            'nama_ayah' => strtoupper(request('ayah')),
            'nama_ibu' => strtoupper(request('ibu')),
            'kk_id' => strtoupper(request('kk_id')),
            'no_paspor' => request('paspor')
        ]);

        $kelahiran = Kelahiran::where('surat_lahir_id', $id)->first();
        $kelahiran->delete();

        return redirect('/penduduk')->with(['msg' => 'Data berhasil disimpan']);
    }

    public function delete(SuratKeteranganDukun $skd) {
        $kelahiran = Kelahiran::where('surat_lahir_id', $skd->id)->first();
        
        if($kelahiran != NULL) {
            $kelahiran->delete();
        }

    	$skd->delete();
    	return redirect('/skd')->with(['msg' => 'Data berhasil dihapus']);
    }

    public function print($id) {
    	$surat = SuratKeteranganDukun::with(['get_penduduk_ibu', 'get_penduduk_ayah', 'get_penduduk_pelapor', 'get_penerbit'])->find($id);
        $penduduk = Penduduk::with(['get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);

    	$pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('skd.print', compact('surat', 'penduduk'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function stat_skd_tahun(Request $request) {
    	$data = [];
    	$i = [0,0,0,0,0,0,0,0,0,0,0,0];

    	if ($request->has('tahun')) {
    		$count_month = SuratKeteranganDukun::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();	
    	}
    	else {
    		$now = Carbon::now();
    		$count_month = SuratKeteranganDukun::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
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

    public function stat_skd_bulan(Request $request) {
    	$data = [];
    	$i = [0,0,0,0];

    	if ($request->has('bulan')) {
    		$count_week = SuratKeteranganDukun::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
    	}
    	else {
    		$now = Carbon::now();
    		$count_week = SuratKeteranganDukun::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
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
