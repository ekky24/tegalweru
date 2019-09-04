<?php

namespace App\Http\Controllers;

use App;
use PDF;
use Illuminate\Http\Request;
use App\KartuKeluarga;
use App\RukunTetangga;
use App\RukunWarga;
use App\Kecamatan;
use App\Penduduk;
use DB;
use PdfReport;

class KartuKeluargaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function insert() {
        $rw = RukunWarga::all();
    	return view('kk.insert', compact('rw'));
    }

    public function show_all(Request $request) {
        $q = "";
        if ($request->has('rw') && $request->has('rt')) {
            if ($request->has('q')) {
                $kk = KartuKeluarga::where([['rukun_warga', request('rw')], ['rukun_tetangga', request('rt')], ['id', 'like', '%' . request('q') . '%']])->orWhere('kepala_keluarga', "like", "%" . request('q'). "%")->orWhere('alamat', "like", "%" . request('q'). "%")->getAktif()->paginate(15);
                $kk_download = KartuKeluarga::with('get_rt', 'get_rw', 'get_penduduk')->where([['rukun_warga', request('rw')], ['rukun_tetangga', request('rt')], ['id', 'like', '%' . request('q') . '%']])->orWhere('kepala_keluarga', "like", "%" . request('q'). "%")->orWhere('alamat', "like", "%" . request('q'). "%")->getAktif()->get();
                $q = request('q');
            }
            else {
                $kk = KartuKeluarga::where([['rukun_warga', request('rw')], ['rukun_tetangga', request('rt')]])->getAktif()->paginate(15);
                $kk_download = KartuKeluarga::with('get_rt', 'get_rw', 'get_penduduk')->where([['rukun_warga', request('rw')], ['rukun_tetangga', request('rt')]])->getAktif()->get();
            }
            
            $rt = RukunTetangga::where('rukun_warga_id', request('rw'))->get();
            $rw = RukunWarga::all();
            $rw_choose = request('rw');
            $rt_choose = request('rt');
        }
        else if($request->has('rw')) {
            if ($request->has('q')) {
                $kk = KartuKeluarga::where([['rukun_warga', request('rw')], ['id', 'like', '%' . request('q') . '%']])->orWhere('kepala_keluarga', "like", "%" . request('q'). "%")->orWhere('alamat', "like", "%" . request('q'). "%")->getAktif()->paginate(15);
                $kk_download = KartuKeluarga::with('get_rt', 'get_rw', 'get_penduduk')->where([['rukun_warga', request('rw')], ['id', 'like', '%' . request('q') . '%']])->orWhere('kepala_keluarga', "like", "%" . request('q'). "%")->orWhere('alamat', "like", "%" . request('q'). "%")->getAktif()->get();
                $q = request('q');
            }
            else {
                $kk = KartuKeluarga::where('rukun_warga', request('rw'))->getAktif()->paginate(15);
                $kk_download = KartuKeluarga::with('get_rt', 'get_rw', 'get_penduduk')->where('rukun_warga', request('rw'))->getAktif()->get();
            }
            
            $rt = RukunTetangga::where('rukun_warga_id', request('rw'))->get();
            $rw = RukunWarga::all();
            $rw_choose = request('rw');
            $rt_choose = "";
        }
        else {
            if ($request->has('q')) {
                $kk = KartuKeluarga::where('id', 'like', '%' . request('q') . '%')->orWhere('kepala_keluarga', "like", "%" . request('q'). "%")->orWhere('alamat', "like", "%" . request('q'). "%")->getAktif()->paginate(15);
                $kk_download = KartuKeluarga::with('get_rt', 'get_rw', 'get_penduduk')->where('id', 'like', '%' . request('q') . '%')->orWhere('kepala_keluarga', "like", "%" . request('q'). "%")->orWhere('alamat', "like", "%" . request('q'). "%")->getAktif()->get();
                $q = request('q');
            }
            else {
                $kk = KartuKeluarga::getAktif()->paginate(15);
                $kk_download = KartuKeluarga::with('get_rt', 'get_rw', 'get_penduduk')->getAktif()->get();
            }
            
            $rw = RukunWarga::all();
            $rw_choose = "";
            $rt_choose = "";
            $rt = "";
        }

        $rt_choose_report = "";
        $rw_choose_report = "";

        if ($rw_choose != "") {
            foreach ($rw as $row) {
                if ($row->id == $rw_choose) {
                    $rw_choose_report = $row->nama;
                }
            }
        }
        if ($rt_choose != "") {
            foreach ($rt as $row) {
                if ($row->id == $rt_choose) {
                    $rt_choose_report = $row->nama;
                }
            }
        }

        return view('kk.show_all', compact('kk', 'kk_download', 'rt', 'rw', 'rw_choose', 'rt_choose', 'q', 'rw_choose_report', 'rt_choose_report'));
    }

    public function getPdf() {
        $this->validate(request(), [
            'kk_download' => 'required',
        ]);

        $rw_choose = "Semua RW";
        $rt_choose = "Semua RT";
        $q = "-";

        if (request('rt_choose') != "") {
            $rt_choose = request('rt_choose');
        }
        if (request('rw_choose') != "") {
            $rw_choose = request('rw_choose');
        }
        if (request('q') != "") {
            $q = request('q');
        }

        $kk = json_decode(request('kk_download'));

        $pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('kk.pdf', compact('kk', 'rt_choose', 'rw_choose', 'q'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function edit(KartuKeluarga $kk) {
        $rw = RukunWarga::all();
        $rt = RukunTetangga::where('rukun_warga_id', $kk->rukun_warga)->get();
        return view('kk.edit', compact('kk','rw', 'rt'));
    }

    public function store() {
        $kepala_keluarga = NULL;

    	$this->validate(request(), [
    		'no_kk' => 'required|numeric',
    		'alamat' => 'required',
    		'rt' => 'required|numeric',
    		'rw' => 'required|numeric',
    		'tgl_pengurusan' => 'required',
    	]);

        if (request('list_nik') !== null) {
            $list_nik = request('list_nik');
            $data = explode("," ,$list_nik);

            foreach ($data as $row) {
                $find = Penduduk::find($row);
                if ($find) {
                    $find->kk_id = request('no_kk');
                    $find->save();

                    if ($find->get_status_hubungan->keterangan == "KEPALA KELUARGA") {
                        $kepala_keluarga = $find->id;
                    }
                }
                else {
                    return back()->withErrors([
                        'message' => 'NIK yang anda masukkan salah.'
                    ]);
                }
            }
        }

        KartuKeluarga::create([
            'id' => request('no_kk'),
            'kepala_keluarga' => $kepala_keluarga,
            'alamat' => strtoupper(request('alamat')),
            'rukun_tetangga' => request('rt'),
            'rukun_warga' => request('rw'),
            'kelurahan' => '3507300003',
            'kode_pos' => '65151',
            'tgl_pengurusan' => request('tgl_pengurusan'),
        ]);

    	return redirect('/kk');
    }

    public function store_edit(KartuKeluarga $kk) {
        $kepala_keluarga = NULL;

        $this->validate(request(), [
            'no_kk' => 'required|numeric',
            'alamat' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'tgl_pengurusan' => 'required',
        ]);

        if (request('list_nik') !== null) {
            $kk->kepala_keluarga = NULL;
            $kk->save();

            if (request('list_nik_lama') != "nothing") {
                $list_nik_lama = request('list_nik_lama');
                $data_lama = explode("," ,$list_nik_lama);

                foreach ($data_lama as $row) {
                    $find = Penduduk::find($row);
                    $find = Penduduk::findOrFail($row);
                    if ($find) {
                        $find->kk_id = NULL;
                        $find->save();
                    }
                }
            }

            if (request('list_nik') != "nothing") {
                $list_nik = request('list_nik');
                $data = explode("," ,$list_nik);

                foreach ($data as $row) {
                    $find = Penduduk::find($row);
                    if ($find) {
                        $find->kk_id = request('no_kk');
                        $find->save();

                        if ($find->get_status_hubungan->keterangan == "KEPALA KELUARGA") {
                            $kepala_keluarga = $find->id;
                        }
                    }
                    else {
                        return back()->withErrors([
                            'message' => 'NIK yang anda masukkan salah.'
                        ]);
                    }
                }
            }
        }

        $kk->kepala_keluarga = $kepala_keluarga;
        $kk->alamat = strtoupper(request('alamat'));
        $kk->rukun_tetangga = request('rt');
        $kk->rukun_warga = request('rw');
        $kk->kelurahan = '3507300006';
        $kk->kode_pos = '65151';
        $kk->tgl_pengurusan = request('tgl_pengurusan');
        $kk->save();

        return redirect("/kk/$kk->id");
    }

    public function show(KartuKeluarga $kk) {
        $anggota = $kk->get_penduduk;
        return view('kk.show', compact('kk', 'anggota'));
    }

    public function keluarga_ajax(KartuKeluarga $kk) {
        $penduduk = Penduduk::where('kk_id', $kk->id)->getAktif()->get();
        return json_encode($penduduk);
    }

    public function rw_ajax(RukunWarga $rw) {
        $rt = $rw->get_rt;
        return json_encode($rt);
    }

    public function stat() {
        return view('kk.stat');
    }

    public function stat_rw_keluarga_ajax() {
        $count_rw_keluarga = KartuKeluarga::with('get_rw')->selectRaw('count(rukun_warga) as count, rukun_warga')->orderBy('rukun_warga')->groupBy('rukun_warga')->getAktif()->get();
        return json_encode($count_rw_keluarga);
    }

    public function stat_rt_keluarga_ajax() {
        $count_rt_keluarga = KartuKeluarga::with(['get_rt', 'get_rw'])->selectRaw('count(rukun_tetangga) as count, rukun_tetangga, rukun_warga')->orderBy('rukun_tetangga')->groupBy(['rukun_tetangga', 'rukun_warga'])->getAktif()->get();
        return json_encode($count_rt_keluarga);
    }
}
