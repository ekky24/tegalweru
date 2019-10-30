<?php

namespace App\Http\Controllers;

use App;
use PDF;
use Illuminate\Http\Request;
use App\Agama;
use App\Pendidikan;
use App\JenisPekerjaan;
use App\StatusNikah;
use App\StatusHubungan;
use App\Kota;
use App\Penduduk;
use App\Kelahiran;
use App\PenyandangCacat;
use App\KartuKeluarga;
use DB;
use Carbon\Carbon;

class PendudukController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['stat', 'stat_agama_ajax', 'stat_pendidikan_ajax', 'stat_kewarganegaraan_ajax', 'stat_jk_ajax', 'stat_usia_ajax', 'stat_status_nikah_ajax', 'stat_jenis_pekerjaan_ajax', 'stat_status_hubungan_ajax', 'stat_status_ajax']);
    }
    
    public function insert() {
    	$agama = Agama::all();
    	$pendidikan = Pendidikan::all();
    	$pekerjaan = JenisPekerjaan::all();
    	$status_nikah = StatusNikah::all();
        $status_hubungan = StatusHubungan::all();
    	$penyandang_cacat = PenyandangCacat::all();
    	
    	return view('penduduk.insert', compact('agama', 'pendidikan', 'pekerjaan', 'status_nikah', 'status_hubungan', 'penyandang_cacat'));
    }

    public function store() {
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

    	$tempat_lahir = Kota::select('id')->where('nama', "like", "%" . request('tempat_lahir') . "%")->get();

    	Penduduk::create([
    		'id' => request('nik'),
            'nama' => strtoupper(request('nama')),
    		'alamat_sebelumnya' => strtoupper(request('alamat_sebelum')),
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

    	return redirect('/penduduk');
    }

    public function store_edit(Penduduk $penduduk) {
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

        $tempat_lahir = Kota::select('id')->where('nama', "like", "%" . request('tempat_lahir') . "%")->get();

        $penduduk->nama = strtoupper(request('nama'));
        $penduduk->alamat_sebelumnya = strtoupper(request('alamat_sebelum'));
        $penduduk->no_paspor = strtoupper(request('paspor'));
        $penduduk->jk = request('jk');
        $penduduk->tempat_lahir = $tempat_lahir[0]->id;
        $penduduk->tgl_lahir = request('tgl_lahir');
        $penduduk->no_akta_lahir = strtoupper(request('akta_lahir'));
        $penduduk->agama_id = request('agama_id');
        if (request('agama_id') != 7) {
            $penduduk->nama_organisasi = null;
        }
        else {
            $penduduk->nama_organisasi = strtoupper(request('nama_organisasi'));
        }
        $penduduk->status_nikah_id = request('status_nikah_id');
        $penduduk->no_akta_nikah = strtoupper(request('akta_nikah'));
        $penduduk->no_akta_cerai = strtoupper(request('akta_cerai'));
        $penduduk->status_hubungan_id = request('status_hubungan_id');
        $penduduk->penyandang_cacat_id = request('penyandang_cacat_id');
        $penduduk->pendidikan_id = request('pendidikan_id');
        $penduduk->jenis_pekerjaan_id = request('jenis_pekerjaan_id');
        $penduduk->kewarganegaraan = request('kewarganegaraan');
        $penduduk->nik_ayah = strtoupper(request('nik_ayah'));
        $penduduk->nama_ayah = strtoupper(request('nama_ayah'));
        $penduduk->nik_ibu = strtoupper(request('nik_ibu'));
        $penduduk->nama_ibu = strtoupper(request('nama_ibu'));
        $penduduk->save();

        return redirect("/penduduk/$penduduk->id");
    }

    public function show_all(Request $request) {
        $jk_choose = "";
        $pendidikan_choose = "";
        $pekerjaan_choose = "";
        $hubungan_choose = "";
        $agama_choose = "";
        $usia_choose = "";
        $search_term = "";

        $penduduk = Penduduk::with(['get_pendidikan', 'get_jenis_pekerjaan']);

        if ($request->has('jk')) {
            $penduduk = $penduduk->where('jk', request('jk'));
            $jk_choose = request('jk');
        }
        if ($request->has('pendidikan')) {
            $penduduk = $penduduk->where('pendidikan_id', request('pendidikan'));
            $pendidikan_choose = request('pendidikan');
        }
        if ($request->has('pekerjaan')) {
            $penduduk = $penduduk->where('jenis_pekerjaan_id', request('pekerjaan'));
            $pekerjaan_choose = request('pekerjaan');
        }
        if ($request->has('hubungan')) {
            $penduduk = $penduduk->where('status_hubungan_id', request('hubungan'));
            $hubungan_choose = request('hubungan');
        }
        if ($request->has('agama')) {
            $penduduk = $penduduk->where('agama_id', request('agama'));
            $agama_choose = request('agama');
        }
        if ($request->has('usia')) {
            if (request('usia') == '0') {
                $penduduk = $penduduk->whereRaw('(DATEDIFF(NOW(), tgl_lahir) DIV 365) < 10');
            }
            elseif (request('usia') == '1') {
                $penduduk = $penduduk->whereRaw('(DATEDIFF(NOW(), tgl_lahir) DIV 365) >= 10 AND (DATEDIFF(NOW(), tgl_lahir) DIV 365) < 20');
            }
            elseif (request('usia') == '2') {
                $penduduk = $penduduk->whereRaw('(DATEDIFF(NOW(), tgl_lahir) DIV 365) >= 20 AND (DATEDIFF(NOW(), tgl_lahir) DIV 365) < 30');
            }
            elseif (request('usia') == '3') {
                $penduduk = $penduduk->whereRaw('(DATEDIFF(NOW(), tgl_lahir) DIV 365) >= 30 AND (DATEDIFF(NOW(), tgl_lahir) DIV 365) < 40');
            }
            elseif (request('usia') == '4') {
                $penduduk = $penduduk->whereRaw('(DATEDIFF(NOW(), tgl_lahir) DIV 365) >= 40 AND (DATEDIFF(NOW(), tgl_lahir) DIV 365) < 50');
            }
            elseif (request('usia') == '5') {
                $penduduk = $penduduk->whereRaw('(DATEDIFF(NOW(), tgl_lahir) DIV 365) >= 50 AND (DATEDIFF(NOW(), tgl_lahir) DIV 365) < 60');
            }
            elseif (request('usia') == '6') {
                $penduduk = $penduduk->whereRaw('(DATEDIFF(NOW(), tgl_lahir) DIV 365) >= 60 AND (DATEDIFF(NOW(), tgl_lahir) DIV 365) < 70');
            }
            elseif (request('usia') == '7') {
                $penduduk = $penduduk->whereRaw('(DATEDIFF(NOW(), tgl_lahir) DIV 365) > 70');
            }
            $usia_choose = request('usia');
        }
        if ($request->has('q')) {
            $penduduk = $penduduk->orWhere('id', "like", "%" . request('q'). "%")->orWhere('nama', "like", "%" . request('q'). "%")->orWhere('kewarganegaraan', "like", "%" . request('q'). "%")->orWhere('no_paspor', "like", "%" . request('q'). "%")->orWhere('nama_ayah', "like", "%" . request('q'). "%")->orWhere('nik_ayah', "like", "%" . request('q'). "%")->orWhere('nama_ibu', "like", "%" . request('q'). "%")->orWhere('kk_id', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }
        if ($request->has('page')) {
            $page_choose = (int) request('page');
        }
        else {
            $page_choose = 1;
        }

        $penduduk_download = $penduduk->getAktif()->get();
        $penduduk = $penduduk->getAktif()->paginate(15, ['*'], 'page', $page_choose);
        $pendidikan = Pendidikan::all();
        $pekerjaan = JenisPekerjaan::all();
        $hubungan = StatusHubungan::all();
        $agama = Agama::all();
        $usia = usia_ajax();

        $jk_choose_report = "";
        $pendidikan_choose_report = "";
        $pekerjaan_choose_report = "";
        $agama_choose_report = "";
        $hubungan_choose_report = "";

        if ($jk_choose != "") {
            if ($jk_choose == "L") {
                $jk_choose_report = "Laki-Laki";
            }
            else {
                $jk_choose_report = "Perempuan";
            }
        }
        if ($pendidikan_choose != "") {
            foreach ($pendidikan as $row) {
                if ($row->id == $pendidikan_choose) {
                    $pendidikan_choose_report = $row->keterangan;
                }
            }
        }
        if ($pekerjaan_choose != "") {
            foreach ($pekerjaan as $row) {
                if ($row->id == $pekerjaan_choose) {
                    $pekerjaan_choose_report = $row->keterangan;
                }
            }
        }
        if ($agama_choose != "") {
            foreach ($agama as $row) {
                if ($row->id == $agama_choose) {
                    $agama_choose_report = $row->keterangan;
                }
            }
        }
        if ($hubungan_choose != "") {
            foreach ($hubungan as $row) {
                if ($row->id == $hubungan_choose) {
                    $hubungan_choose_report = $row->keterangan;
                }
            }
        }

        return view('penduduk.show_all', compact('penduduk', 'pendidikan', 'pekerjaan', 'hubungan', 'jk_choose', 'pendidikan_choose', 'pekerjaan_choose', 'hubungan_choose', 'agama', 'agama_choose', 'search_term', 'penduduk_download', 'jk_choose_report', 'pendidikan_choose_report', 'agama_choose_report', 'pekerjaan_choose_report', 'hubungan_choose_report', 'usia_choose', 'usia', 'page_choose'));
    }

    public function getPdf() {
        $this->validate(request(), [
            'penduduk_download' => 'required',
        ]);

        $jk_choose = "Semua Jenis Kelamin";
        $pendidikan_choose = "Semua Tingkat Pendidikan";
        $pekerjaan_choose = "Semua Jenis Pekerjaan";
        $agama_choose = "Semua Agama";
        $hubungan_choose = "Semua Hubungan Keluarga";
        $search_term = "-";

        if (request('jk_choose') != "") {
            $jk_choose = request('jk_choose');
        }
        if (request('pendidikan_choose') != "") {
            $pendidikan_choose = request('pendidikan_choose');
        }
        if (request('pekerjaan_choose') != "") {
            $pekerjaan_choose = request('pekerjaan_choose');
        }
        if (request('agama_choose') != "") {
            $agama_choose = request('agama_choose');
        }
        if (request('hubungan_choose') != "") {
            $hubungan_choose = request('hubungan_choose');
        }
        if (request('search_term') != "") {
            $search_term = request('search_term');
        }

        $penduduk = json_decode(request('penduduk_download'));

        $pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('penduduk.pdf', compact('penduduk', 'jk_choose', 'pendidikan_choose', 'pekerjaan_choose', 'agama_choose', 'hubungan_choose', 'search_term'));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function show(Penduduk $penduduk) {
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk) {
        $agama = Agama::all();
        $pendidikan = Pendidikan::all();
        $pekerjaan = JenisPekerjaan::all();
        $status_nikah = StatusNikah::all();
        $status_hubungan = StatusHubungan::all();
        $penyandang_cacat = PenyandangCacat::all();
        return view('penduduk.edit', compact('penduduk', 'agama', 'pendidikan', 'pekerjaan', 'status_nikah', 'status_hubungan', 'penyandang_cacat'));
    }

    public function penduduk_ajax_kota() {
    	$kota = Kota::select('nama', 'id')->get();
    	$kota_send = array();
    	$kota_temp = array();

    	foreach ($kota as $row) {
    		$kota_temp['value'] = $row->id;
    		$kota_temp['nama'] = $row->nama;
    		array_push($kota_send, $kota_temp);
    	}

    	return $kota_send;
    }

    public function penduduk_ajax_nik() {
        $nik = Penduduk::select('id', 'nama')->where('kk_id', NULL)->getAktif()->get();
        return $nik;
    }

    public function penduduk_ajax_kematian() {
        $nik = Penduduk::with(['get_kk', 'get_tempat_lahir', 'get_agama'])->getAktif()->get();
        return $nik;
    }

    public function penduduk_ajax_nik_kepala() {
        $nik = Penduduk::select('id', 'nama')->where('status_hubungan_id', 1)->getAktif()->get();
        return $nik;
    }

    public function stat() {
        $count_penduduk = Penduduk::getAktif()->get()->count();
        $count_jk = Penduduk::selectRaw('count(jk) as count')->orderBy('jk')->groupBy('jk')->getAktif()->get();
        $count_status_nikah = Penduduk::with('get_status_nikah')->selectRaw('count(status_nikah_id) as count, status_nikah_id')->whereRaw('status_nikah_id is not null')->groupBy('status_nikah_id')->getAktif()->get();
        $count_agama = Penduduk::with('get_agama')->selectRaw('count(agama_id) as count, agama_id')->whereRaw('agama_id is not null')->groupBy('agama_id')->getAktif()->get();
        $count_status_hubungan = Penduduk::with('get_status_hubungan')->selectRaw('count(status_hubungan_id) as count, status_hubungan_id')->whereRaw('status_hubungan_id is not null')->groupBy('status_hubungan_id')->getAktif()->get();
        $count_pendidikan = Penduduk::with('get_pendidikan')->selectRaw('count(pendidikan_id) as count, pendidikan_id')->whereRaw('pendidikan_id is not null')->groupBy('pendidikan_id')->getAktif()->get();

        $c = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        $age_count = [];

        $penduduk = Penduduk::selectRaw('YEAR(CURRENT_TIMESTAMP) - YEAR(tgl_lahir) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(tgl_lahir, 5)) as age')->getAktif()->get();
        
        foreach ($penduduk as $row) {
            $age = $row->age;

            if ($age >= 0 && $age <= 5) {
                $c[0]++;
            }
            elseif ($age > 5 && $age <= 10) {
                $c[1]++;
            }
            elseif ($age > 10 && $age <= 15) {
                $c[2]++;
            }
            elseif ($age > 15 && $age <= 20) {
                $c[3]++;
            }
            elseif ($age > 20 && $age <= 25) {
                $c[4]++;
            }
            elseif ($age > 25 && $age <= 30) {
                $c[5]++;
            }
            elseif ($age > 30 && $age <= 35) {
                $c[6]++;
            }
            elseif ($age > 35 && $age <= 40) {
                $c[7]++;
            }
            elseif ($age > 40 && $age <= 45) {
                $c[8]++;
            }
            elseif ($age > 45 && $age <= 50) {
                $c[9]++;
            }
            elseif ($age > 50 && $age <= 55) {
                $c[10]++;
            }
            elseif ($age > 55 && $age <= 60) {
                $c[11]++;
            }
            elseif ($age > 60) {
                $c[12]++;
            }
        }

        if ($c[0] > 0) {
            $send['count'] = $c[0];
            $send['nama'] = "0 - 5";
            array_push($age_count, $send);
        }
        if ($c[1] > 0) {
            $send['count'] = $c[1];
            $send['nama'] = "6 - 10";
            array_push($age_count, $send);
        }
        if ($c[2] > 0) {
            $send['count'] = $c[2];
            $send['nama'] = "11 - 15";
            array_push($age_count, $send);
        }
        if ($c[3] > 0) {
            $send['count'] = $c[3];
            $send['nama'] = "16 - 20";
            array_push($age_count, $send);
        }
        if ($c[4] > 0) {
            $send['count'] = $c[4];
            $send['nama'] = "21 - 25";
            array_push($age_count, $send);
        }
        if ($c[5] > 0) {
            $send['count'] = $c[5];
            $send['nama'] = "26 - 30";
            array_push($age_count, $send);
        }
        if ($c[6] > 0) {
            $send['count'] = $c[6];
            $send['nama'] = "31 - 35";
            array_push($age_count, $send);
        }
        if ($c[7] > 0) {
            $send['count'] = $c[7];
            $send['nama'] = "36 - 40";
            array_push($age_count, $send);
        }
        if ($c[8] > 0) {
            $send['count'] = $c[8];
            $send['nama'] = "41 - 45";
            array_push($age_count, $send);
        }
        if ($c[9] > 0) {
            $send['count'] = $c[9];
            $send['nama'] = "46 - 50";
            array_push($age_count, $send);
        }
        if ($c[10] > 0) {
            $send['count'] = $c[10];
            $send['nama'] = "51 - 55";
            array_push($age_count, $send);
        }
        if ($c[11] > 0) {
            $send['count'] = $c[11];
            $send['nama'] = "56 - 60";
            array_push($age_count, $send);
        }
        if ($c[12] > 0) {
            $send['count'] = $c[12];
            $send['nama'] = "> 60";
            array_push($age_count, $send);
        }

        return view('penduduk.stat', compact('count_jk', 'age_count', 'count_agama', 'count_pendidikan', 'count_status_hubungan', 'count_status_nikah', 'count_penduduk'));
    }

    public function stat_agama_ajax() {
        $count_agama = Penduduk::with('get_agama')->selectRaw('count(agama_id) as count, agama_id')->whereRaw('agama_id is not null')->groupBy('agama_id')->getAktif()->get();
        return json_encode($count_agama);
    }

    public function stat_status_nikah_ajax() {
        $count_status_nikah = Penduduk::with('get_status_nikah')->selectRaw('count(status_nikah_id) as count, status_nikah_id')->whereRaw('status_nikah_id is not null')->groupBy('status_nikah_id')->getAktif()->get();
        return json_encode($count_status_nikah);
    }

    public function stat_pendidikan_ajax() {
        $count_pendidikan = Penduduk::with('get_pendidikan')->selectRaw('count(pendidikan_id) as count, pendidikan_id')->whereRaw('pendidikan_id is not null')->groupBy('pendidikan_id')->getAktif()->get();
        return json_encode($count_pendidikan);
    }

    public function stat_jenis_pekerjaan_ajax() {
        $count_jenis_pekerjaan = Penduduk::with('get_jenis_pekerjaan')->selectRaw('count(jenis_pekerjaan_id) as count, jenis_pekerjaan_id')->whereRaw('jenis_pekerjaan_id is not null')->groupBy('jenis_pekerjaan_id')->getAktif()->get();
        return json_encode($count_jenis_pekerjaan);
    }

    public function stat_status_hubungan_ajax() {
        $count_status_hubungan = Penduduk::with('get_status_hubungan')->selectRaw('count(status_hubungan_id) as count, status_hubungan_id')->whereRaw('status_hubungan_id is not null')->groupBy('status_hubungan_id')->getAktif()->get();
        return json_encode($count_status_hubungan);
    }

    public function stat_kewarganegaraan_ajax() {
        $count_kewarganegaraan = Penduduk::selectRaw('count(kewarganegaraan) as count')->orderBy('kewarganegaraan')->groupBy('kewarganegaraan')->getAktif()->get();
        return json_encode($count_kewarganegaraan);
    }

    public function stat_status_ajax() {
        $data = [];
        $count_penduduk = Penduduk::getAktif()->count();
        $count_penduduk = ['count' => $count_penduduk];
        array_push($data, $count_penduduk);

        $count_kelahiran = Kelahiran::get()->count();
        $count_kelahiran = ['count' => $count_kelahiran];
        array_push($data, $count_kelahiran);
        return $data;
    }

    public function stat_jk_ajax() {
        $count_jk = Penduduk::selectRaw('count(jk) as count')->orderBy('jk')->groupBy('jk')->getAktif()->get();
        return json_encode($count_jk);
    }

    public function stat_usia_ajax() {
        $c = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        $age_count = [];

        $penduduk = Penduduk::selectRaw('YEAR(CURRENT_TIMESTAMP) - YEAR(tgl_lahir) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(tgl_lahir, 5)) as age')->getAktif()->get();
        
        foreach ($penduduk as $row) {
            $age = $row->age;

            if ($age >= 0 && $age <= 5) {
                $c[0]++;
            }
            elseif ($age > 5 && $age <= 10) {
                $c[1]++;
            }
            elseif ($age > 10 && $age <= 15) {
                $c[2]++;
            }
            elseif ($age > 15 && $age <= 20) {
                $c[3]++;
            }
            elseif ($age > 20 && $age <= 25) {
                $c[4]++;
            }
            elseif ($age > 25 && $age <= 30) {
                $c[5]++;
            }
            elseif ($age > 30 && $age <= 35) {
                $c[6]++;
            }
            elseif ($age > 35 && $age <= 40) {
                $c[7]++;
            }
            elseif ($age > 40 && $age <= 45) {
                $c[8]++;
            }
            elseif ($age > 45 && $age <= 50) {
                $c[9]++;
            }
            elseif ($age > 50 && $age <= 55) {
                $c[10]++;
            }
            elseif ($age > 55 && $age <= 60) {
                $c[11]++;
            }
            elseif ($age > 60) {
                $c[12]++;
            }
        }

        if ($c[0] > 0) {
            $send['count'] = $c[0];
            $send['nama'] = "0 - 5";
            array_push($age_count, $send);
        }
        if ($c[1] > 0) {
            $send['count'] = $c[1];
            $send['nama'] = "6 - 10";
            array_push($age_count, $send);
        }
        if ($c[2] > 0) {
            $send['count'] = $c[2];
            $send['nama'] = "11 - 15";
            array_push($age_count, $send);
        }
        if ($c[3] > 0) {
            $send['count'] = $c[3];
            $send['nama'] = "16 - 20";
            array_push($age_count, $send);
        }
        if ($c[4] > 0) {
            $send['count'] = $c[4];
            $send['nama'] = "21 - 25";
            array_push($age_count, $send);
        }
        if ($c[5] > 0) {
            $send['count'] = $c[5];
            $send['nama'] = "26 - 30";
            array_push($age_count, $send);
        }
        if ($c[6] > 0) {
            $send['count'] = $c[6];
            $send['nama'] = "31 - 35";
            array_push($age_count, $send);
        }
        if ($c[7] > 0) {
            $send['count'] = $c[7];
            $send['nama'] = "36 - 40";
            array_push($age_count, $send);
        }
        if ($c[8] > 0) {
            $send['count'] = $c[8];
            $send['nama'] = "41 - 45";
            array_push($age_count, $send);
        }
        if ($c[9] > 0) {
            $send['count'] = $c[9];
            $send['nama'] = "46 - 50";
            array_push($age_count, $send);
        }
        if ($c[10] > 0) {
            $send['count'] = $c[10];
            $send['nama'] = "51 - 55";
            array_push($age_count, $send);
        }
        if ($c[11] > 0) {
            $send['count'] = $c[11];
            $send['nama'] = "56 - 60";
            array_push($age_count, $send);
        }
        if ($c[12] > 0) {
            $send['count'] = $c[12];
            $send['nama'] = "> 60";
            array_push($age_count, $send);
        }
        
        return json_encode($age_count);
    }

    public function stat_download() {
        $count_penduduk = Penduduk::getAktif()->get()->count();
        // AGAMA
        $data =  json_decode($this->stat_agama_ajax());
        $counter = 0;
        $agama_arr = [];
        foreach ($data as $row) $counter += $row->count;

        foreach ($data as $row) {
            $presentase = round($row->count / $counter * 100, 2);
            array_push($agama_arr, [$row->get_agama->keterangan, $row->count, $presentase]);
        }
        
        // STATUS NIKAH
        $data =  json_decode($this->stat_status_nikah_ajax());
        $counter = 0;
        $status_nikah_arr = [];
        foreach ($data as $row) $counter += $row->count;

        foreach ($data as $row) {
            $presentase = round($row->count / $counter * 100, 2);
            array_push($status_nikah_arr, [$row->get_status_nikah->keterangan, $row->count, $presentase]);
        }

        // PENDIDIKAN
        $data =  json_decode($this->stat_pendidikan_ajax());
        $counter = 0;
        $pendidikan_arr = [];
        foreach ($data as $row) $counter += $row->count;

        foreach ($data as $row) {
            $presentase = round($row->count / $counter * 100, 2);
            array_push($pendidikan_arr, [$row->get_pendidikan->keterangan, $row->count, $presentase]);
        }

        // JENIS PEKERJAAN
        $data =  json_decode($this->stat_jenis_pekerjaan_ajax());
        $counter = 0;
        $jenis_pekerjaan_arr = [];
        foreach ($data as $row) $counter += $row->count;

        foreach ($data as $row) {
            $presentase = round($row->count / $counter * 100, 2);
            array_push($jenis_pekerjaan_arr, [$row->get_jenis_pekerjaan->keterangan, $row->count, $presentase]);
        }

        // STATUS HUBUNGAN
        $data =  json_decode($this->stat_status_hubungan_ajax());
        $counter = 0;
        $status_hubungan_arr = [];
        foreach ($data as $row) $counter += $row->count;

        foreach ($data as $row) {
            $presentase = round($row->count / $counter * 100, 2);
            array_push($status_hubungan_arr, [$row->get_status_hubungan->keterangan, $row->count, $presentase]);
        }   

        // JENIS KELAMIN
        $data =  json_decode($this->stat_jk_ajax());
        $counter = 0;
        $jk_arr = [];
        foreach ($data as $row) $counter += $row->count;

        foreach ($data as $i => $row) {
            $presentase = round($row->count / $counter * 100, 2);
            if($i == 0) array_push($jk_arr, ["L", $row->count, $presentase]);
            else array_push($jk_arr, ["P", $row->count, $presentase]);
        }    

        // USIA
        $data =  json_decode($this->stat_usia_ajax());
        $counter = 0;
        $usia_arr = [];
        foreach ($data as $row) $counter += $row->count;

        foreach ($data as $row) {
            $presentase = round($row->count / $counter * 100, 2);
            array_push($usia_arr, [$row->nama, $row->count, $presentase]);
        } 

        // RW
        $data =  json_decode($this->stat_rw_keluarga_ajax());
        $counter = 0;
        $rw_arr = [];
        foreach ($data as $row) $counter += $row->count;

        foreach ($data as $row) {
            $presentase = round($row->count / $counter * 100, 2);
            array_push($rw_arr, [$row->get_rw->nama, $row->count, $presentase]);
        }

        // RT
        $data =  json_decode($this->stat_rt_keluarga_ajax());
        $counter = 0;
        $rt_arr = [];
        foreach ($data as $row) $counter += $row->count;

        foreach ($data as $row) {
            $presentase = round($row->count / $counter * 100, 2);
            array_push($rt_arr, [$row->get_rw->nama, $row->get_rt->nama, $row->count, $presentase]);
        }

        $pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('penduduk.stat_download', compact('agama_arr', 'status_nikah_arr', 'pendidikan_arr', 'jenis_pekerjaan_arr', 'status_hubungan_arr', 'jk_arr', 'usia_arr', 'count_penduduk', 'rw_arr', 'rt_arr'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    // DARI KK CONTROLLER
    public function stat_rw_keluarga_ajax() {
        $count_rw_keluarga = KartuKeluarga::with(['get_rw'])->selectRaw('count(penduduks.id) as count, kartu_keluargas.rukun_warga')->leftJoin('penduduks', 'kartu_keluargas.id', '=', 'penduduks.kk_id')->whereRaw('kartu_keluargas.rukun_warga is not null')->whereNull('penduduks.status')->orderBy('kartu_keluargas.rukun_warga')->groupBy('kartu_keluargas.rukun_warga')->get();

        return json_encode($count_rw_keluarga);
    }

    public function stat_rt_keluarga_ajax() {
        $count_rt_keluarga = KartuKeluarga::with(['get_rt', 'get_rw'])->selectRaw('count(penduduks.id) as count, kartu_keluargas.rukun_tetangga, kartu_keluargas.rukun_warga')->leftJoin('penduduks', 'kartu_keluargas.id', '=', 'penduduks.kk_id')->whereRaw('kartu_keluargas.rukun_tetangga is not null')->whereRaw('kartu_keluargas.rukun_warga is not null')->whereNull('penduduks.status')->orderBy('kartu_keluargas.rukun_tetangga')->groupBy('kartu_keluargas.rukun_warga')->groupBy('kartu_keluargas.rukun_tetangga')->get();
        return json_encode($count_rt_keluarga);
    }
}

function usia_ajax() {
    $c = [0,0,0,0,0,0,0,0];
        $age_name = [];

        $penduduk = Penduduk::selectRaw('YEAR(CURRENT_TIMESTAMP) - YEAR(tgl_lahir) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(tgl_lahir, 5)) as age')->getAktif()->get();
        
        foreach ($penduduk as $row) {
            $age = $row->age;

            if ($age < 10) {
                $c[0]++;
            }
            elseif ($age >= 10 && $age < 20) {
                $c[1]++;
            }
            elseif ($age >= 20 && $age < 30) {
                $c[2]++;
            }
            elseif ($age >= 30 && $age < 40) {
                $c[3]++;
            }
            elseif ($age >= 40 && $age < 50) {
                $c[4]++;
            }
            elseif ($age >= 50 && $age < 60) {
                $c[5]++;
            }
            elseif ($age >= 60 && $age < 70) {
                $c[6]++;
            }
            elseif ($age > 70) {
                $c[7]++;
            }
        }

        if ($c[0] > 0) {
            array_push($age_name, "Kurang dari 10 thn");
        }
        if ($c[1] > 0) {
            array_push($age_name, "10 - 20");
        }
        if ($c[2] > 0) {
            array_push($age_name, "20 - 30");
        }
        if ($c[3] > 0) {
            array_push($age_name, "30 - 40");
        }
        if ($c[4] > 0) {
            array_push($age_name, "40 - 50");
        }
        if ($c[5] > 0) {
            array_push($age_name, "50 - 60");
        }
        if ($c[6] > 0) {
            array_push($age_name, "60 - 70");
        }
        if ($c[7] > 0) {
            array_push($age_name, "Lebih dari 70 thn");
        }
    
        return $age_name;
}
