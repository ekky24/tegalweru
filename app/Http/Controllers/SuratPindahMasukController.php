<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Penerbit;
use App\SuratPindahMasuk;
use App\PindahMasuk;
use Carbon\Carbon;
use DB;
use App\Penduduk;
use App\Agama;
use App\Pendidikan;
use App\JenisPekerjaan;
use App\StatusNikah;
use App\StatusHubungan;
use App\Kota;
use App\Kelahiran;
use App\PenyandangCacat;

class SuratPindahMasukController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}

	public function insert() {
    	$penerbit = Penerbit::all();

    	return view('pindah_masuk.insert', compact('penerbit'));
    }

    public function store() {
    	$this->validate(request(), [
    		'nomor' => 'required',
            'nama_pemohon' => 'required',
            'kk_lama' => 'nullable',
            'alamat_asal' => 'required',
            'alamat_tujuan' => 'required',
            'alasan_pindah' => 'required',
    	]);

    	$pindah = SuratPindahMasuk::create([
    		'nomor' => strtoupper(request('nomor')),
            'nama_pemohon' => strtoupper(request('nama_pemohon')),
            'kk_lama' => strtoupper(request('kk_lama')),
            'alamat_asal' => strtoupper(request('alamat_asal')),
            'alamat_tujuan' => strtoupper(request('alamat_tujuan')),
            'alasan_pindah' => strtoupper(request('alasan_pindah')),
    	]);

        $agama = Agama::all();
        $pendidikan = Pendidikan::all();
        $pekerjaan = JenisPekerjaan::all();
        $status_nikah = StatusNikah::all();
        $status_hubungan = StatusHubungan::all();
        $penyandang_cacat = PenyandangCacat::all();

    	return view("pindah_masuk.insert_penduduk", compact('pindah', 'agama', 'pendidikan', 'pekerjaan', 'status_nikah', 'status_hubungan', 'penyandang_cacat'));
    }

    public function insert_penduduk(SuratPindahMasuk $pindah) {
        $this->validate(request(), [
            'nik' => 'required|numeric',
            'nama' => 'required',
            'alamat_sebelum' => 'nullable',
            'paspor' => 'nullable',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'akta_lahir' => 'nullable',
            'agama_id' => 'required|numeric',
            'nama_organisasi' => 'nullable',
            'status_nikah_id' => 'required|numeric',
            'akta_nikah' => 'nullable',
            'akta_cerai' => 'nullable',
            'status_hubungan_id' => 'required|numeric',
            'penyandang_cacat_id' => 'nullable',
            'pendidikan_id' => 'required|numeric',
            'jenis_pekerjaan_id' => 'required|numeric',
            'kewarganegaraan' => 'required',
            'nik_ayah' => 'nullable',
            'nama_ayah' => 'nullable',
            'nik_ibu' => 'nullable',
            'nama_ibu' => 'nullable'
        ]);

        $tempat_lahir = Kota::select('id')->where('nama', request('tempat_lahir'))->get();

        Penduduk::create([
            'id' => request('nik'),
            'nama' => strtoupper(request('nama')),
            'alamat_sebelumnya' => $pindah->alamat_asal,
            'no_paspor' => request('paspor'),
            'jk' => request('jk'),
            'tempat_lahir' => $tempat_lahir[0]->id,
            'tgl_lahir' => request('tgl_lahir'),
            'no_akta_lahir' => request('akta_lahir'),
            'agama_id' => request('agama_id'),
            'nama_organisasi' => strtoupper(request('nama_organisasi')),
            'status_nikah_id' => request('status_nikah_id'),
            'no_akta_nikah' => request('akta_nikah'),
            'no_akta_cerai' => request('akta_cerai'),
            'status_hubungan_id' => request('status_hubungan_id'),
            'penyandang_cacat_id' => request('penyandang_cacat_id'),
            'pendidikan_id' => request('pendidikan_id'),
            'jenis_pekerjaan_id' => request('jenis_pekerjaan_id'),
            'kewarganegaraan' => request('kewarganegaraan'),
            'nik_ayah' => strtoupper(request('nik_ayah')),
            'nama_ayah' => strtoupper(request('nama_ayah')),
            'nik_ibu' => strtoupper(request('nik_ibu')),
            'nama_ibu' => strtoupper(request('nama_ibu')),
        ]);

        PindahMasuk::create([
            'penduduk_id' => request('nik'),
            'surat_masuk_id' => $pindah->id,
        ]);

        if (request('submit_button') == 'lagi') {
            $agama = Agama::all();
            $pendidikan = Pendidikan::all();
            $pekerjaan = JenisPekerjaan::all();
            $status_nikah = StatusNikah::all();
            $status_hubungan = StatusHubungan::all();
            $penyandang_cacat = PenyandangCacat::all();
            
            return view("pindah_masuk.insert_penduduk", compact('pindah', 'agama', 'pendidikan', 'pekerjaan', 'status_nikah', 'status_hubungan', 'penyandang_cacat'));
        }
        return redirect('/pindah_masuk/' . $pindah->id);
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$pindah = new SuratPindahMasuk();

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
            $pindah = $pindah->orWhere('nama_pemohon', "like", "%" . request('q'). "%")->orWhere('alamat_asal', "like", "%" . request('q'). "%")->orWhere('alamat_tujuan', "like", "%" . request('q'). "%")->orWhere('nomor', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }

        $pindah_download = $pindah->get();
        $pindah = $pindah->paginate(15);
    	
    	return view('pindah_masuk.show_all', compact('pindah', 'search_term', 'tahun_choose', 'bulan_choose', 'pindah_download'));
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
        $pdf->loadView('pindah_masuk.pdf', compact('surat', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function show($id) {
    	$pindah = SuratPindahMasuk::find($id);
        $pengikut = PindahMasuk::with('get_penduduk')->where('surat_masuk_id', $id)->get();

    	return view('pindah_masuk.show', compact('pindah', 'pengikut'));
    }

    public function edit($id) {
    	$pindah = SuratPindahMasuk::find($id);
    	return view('pindah_masuk.edit', compact('pindah'));
    }

    public function store_edit(SuratPindahMasuk $pindah) {
    	$this->validate(request(), [
    		'nomor' => 'required',
            'nama_pemohon' => 'required',
            'kk_lama' => 'nullable',
            'alamat_asal' => 'required',
            'alamat_tujuan' => 'required',
            'alasan_pindah' => 'required',
    	]);

        $pindah->nomor = strtoupper(request('nomor'));
        $pindah->nama_pemohon = strtoupper(request('nama_pemohon'));
        $pindah->kk_lama = strtoupper(request('kk_lama'));
        $pindah->alamat_asal = strtoupper(request('alamat_asal'));
        $pindah->alamat_tujuan = strtoupper(request('alamat_tujuan'));
        $pindah->alasan_pindah = strtoupper(request('alasan_pindah'));
    	$pindah->save();

    	return redirect("/pindah_masuk/$pindah->id");
    }

    public function delete(SuratPindahMasuk $pindah) {
    	$find = PindahMasuk::where('surat_masuk_id', $pindah->id)->get();
        foreach ($find as $key => $row) {
            $penduduk = Penduduk::find($row->penduduk_id);
            if ($penduduk != NULL) {
                $penduduk->delete();
            }

            $row->delete();
        }

        $pindah->delete();
    	return redirect('/pindah_masuk');
    }

    public function stat_pindah_tahun(Request $request) {
        $data = [];
        $i = [0,0,0,0,0,0,0,0,0,0,0,0];

        if ($request->has('tahun')) {
            $count_month = SuratPindahMasuk::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();    
        }
        else {
            $now = Carbon::now();
            $count_month = SuratPindahMasuk::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
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

    public function stat_pindah_bulan(Request $request) {
        $data = [];
        $i = [0,0,0,0];

        if ($request->has('bulan')) {
            $count_week = SuratPindahMasuk::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
        }
        else {
            $now = Carbon::now();
            $count_week = SuratPindahMasuk::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
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
