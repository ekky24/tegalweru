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
use DB;
use Carbon\Carbon;

class PendudukController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function insert() {
    	$agama = Agama::all();
    	$pendidikan = Pendidikan::all();
    	$pekerjaan = JenisPekerjaan::all();
    	$status_nikah = StatusNikah::all();
    	$status_hubungan = StatusHubungan::all();
    	
    	return view('penduduk.insert', compact('agama', 'pendidikan', 'pekerjaan', 'status_nikah', 'status_hubungan'));
    }

    public function store() {
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
    		'ibu' => 'required'
    	]);

    	$tempat_lahir = Kota::select('id')->where('nama', request('tempat_lahir'))->get();

    	Penduduk::create([
    		'id' => request('nik'),
    		'nama' => strtoupper(request('nama')),
    		'jk' => request('jk'),
    		'tempat_lahir' => $tempat_lahir[0]->id,
    		'tgl_lahir' => request('tgl_lahir'),
    		'agama_id' => request('agama_id'),
    		'pendidikan_id' => request('pendidikan_id'),
    		'jenis_pekerjaan_id' => request('jenis_pekerjaan_id'),
    		'status_nikah_id' => request('status_nikah_id'),
    		'status_hubungan_id' => request('status_hubungan_id'),
    		'kewarganegaraan' => request('kewarganegaraan'),
    		'ayah' => strtoupper(request('ayah')),
    		'ibu' => strtoupper(request('ibu')),
    		'no_kitas' => request('kitas'),
    		'no_paspor' => request('paspor')
    	]);

    	return redirect('/penduduk');
    }

    public function store_edit(Penduduk $penduduk) {
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
            'ibu' => 'required'
        ]);

        $tempat_lahir = Kota::select('id')->where('nama', request('tempat_lahir'))->get();

        $penduduk->nama = strtoupper(request('nama'));
        $penduduk->jk = request('jk');
        $penduduk->tempat_lahir = $tempat_lahir[0]->id;
        $penduduk->tgl_lahir = request('tgl_lahir');
        $penduduk->agama_id = request('agama_id');
        $penduduk->pendidikan_id = request('pendidikan_id');
        $penduduk->jenis_pekerjaan_id = request('jenis_pekerjaan_id');
        $penduduk->status_nikah_id = request('status_nikah_id');
        $penduduk->status_hubungan_id = request('status_hubungan_id');
        $penduduk->kewarganegaraan = request('kewarganegaraan');
        $penduduk->ayah = strtoupper(request('ayah'));
        $penduduk->ibu = strtoupper(request('ibu'));
        $penduduk->no_kitas = request('kitas');
        $penduduk->no_paspor = request('paspor');
        $penduduk->save();

        return redirect("/penduduk/$penduduk->id");
    }

    public function show_all(Request $request) {
        $jk_choose = "";
        $pendidikan_choose = "";
        $pekerjaan_choose = "";
        $hubungan_choose = "";
        $agama_choose = "";
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
        if ($request->has('q')) {
            $penduduk = $penduduk->orWhere('id', "like", "%" . request('q'). "%")->orWhere('nama', "like", "%" . request('q'). "%")->orWhere('kewarganegaraan', "like", "%" . request('q'). "%")->orWhere('no_paspor', "like", "%" . request('q'). "%")->orWhere('no_kitas', "like", "%" . request('q'). "%")->orWhere('ayah', "like", "%" . request('q'). "%")->orWhere('ibu', "like", "%" . request('q'). "%")->orWhere('kk_id', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }
        
        $penduduk_download = $penduduk->getAktif()->get();
        $penduduk = $penduduk->getAktif()->paginate(15);
        $pendidikan = Pendidikan::all();
        $pekerjaan = JenisPekerjaan::all();
        $hubungan = StatusHubungan::all();
        $agama = Agama::all();

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
        
        return view('penduduk.show_all', compact('penduduk', 'pendidikan', 'pekerjaan', 'hubungan', 'jk_choose', 'pendidikan_choose', 'pekerjaan_choose', 'hubungan_choose', 'agama', 'agama_choose', 'search_term', 'penduduk_download', 'jk_choose_report', 'pendidikan_choose_report', 'agama_choose_report', 'pekerjaan_choose_report', 'hubungan_choose_report'));
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
        $pdf->setPaper('legal', 'portrait');
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
        return view('penduduk.edit', compact('penduduk', 'agama', 'pendidikan', 'pekerjaan', 'status_nikah', 'status_hubungan'));
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
        $nik = Penduduk::with(['get_kk', 'get_agama'])->getAktif()->get();
        return $nik;
    }

    public function penduduk_ajax_nik_kepala() {
        $nik = Penduduk::select('id', 'nama')->where('status_hubungan_id', 1)->getAktif()->get();
        return $nik;
    }

    public function stat() {
        return view('penduduk.stat');
    }

    public function stat_agama_ajax() {
        $count_agama = Penduduk::with('get_agama')->selectRaw('count(agama_id) as count, agama_id')->groupBy('agama_id')->getAktif()->get();
        return json_encode($count_agama);
    }

    public function stat_status_nikah_ajax() {
        $count_status_nikah = Penduduk::with('get_status_nikah')->selectRaw('count(status_nikah_id) as count, status_nikah_id')->groupBy('status_nikah_id')->getAktif()->get();
        return json_encode($count_status_nikah);
    }

    public function stat_pendidikan_ajax() {
        $count_pendidikan = Penduduk::with('get_pendidikan')->selectRaw('count(pendidikan_id) as count, pendidikan_id')->groupBy('pendidikan_id')->getAktif()->get();
        return json_encode($count_pendidikan);
    }

    public function stat_jenis_pekerjaan_ajax() {
        $count_jenis_pekerjaan = Penduduk::with('get_jenis_pekerjaan')->selectRaw('count(jenis_pekerjaan_id) as count, jenis_pekerjaan_id')->groupBy('jenis_pekerjaan_id')->getAktif()->get();
        return json_encode($count_jenis_pekerjaan);
    }

    public function stat_status_hubungan_ajax() {
        $count_status_hubungan = Penduduk::with('get_status_hubungan')->selectRaw('count(status_hubungan_id) as count, status_hubungan_id')->groupBy('status_hubungan_id')->getAktif()->get();
        return json_encode($count_status_hubungan);
    }

    public function stat_kewarganegaraan_ajax() {
        $count_kewarganegaraan = Penduduk::selectRaw('count(kewarganegaraan) as count')->orderBy('kewarganegaraan')->groupBy('kewarganegaraan')->getAktif()->get();
        return json_encode($count_kewarganegaraan);
    }

    public function stat_jk_ajax() {
        $count_jk = Penduduk::selectRaw('count(jk) as count')->orderBy('jk')->groupBy('jk')->getAktif()->get();
        return json_encode($count_jk);
    }

    public function stat_usia_ajax() {
        $c = [0,0,0,0,0,0,0,0];
        $age_count = [];

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
            $send['count'] = $c[0];
            $send['nama'] = "< 10";
            array_push($age_count, $send);
        }
        if ($c[1] > 0) {
            $send['count'] = $c[1];
            $send['nama'] = "10 - 20";
            array_push($age_count, $send);
        }
        if ($c[2] > 0) {
            $send['count'] = $c[2];
            $send['nama'] = "20 - 30";
            array_push($age_count, $send);
        }
        if ($c[3] > 0) {
            $send['count'] = $c[3];
            $send['nama'] = "30 - 40";
            array_push($age_count, $send);
        }
        if ($c[4] > 0) {
            $send['count'] = $c[4];
            $send['nama'] = "40 - 50";
            array_push($age_count, $send);
        }
        if ($c[5] > 0) {
            $send['count'] = $c[5];
            $send['nama'] = "50 - 60";
            array_push($age_count, $send);
        }
        if ($c[6] > 0) {
            $send['count'] = $c[6];
            $send['nama'] = "60 - 70";
            array_push($age_count, $send);
        }
        if ($c[7] > 0) {
            $send['count'] = $c[7];
            $send['nama'] = "> 70";
            array_push($age_count, $send);
        }
        
        return json_encode($age_count);
    }
}
