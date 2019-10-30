<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Penerbit;
use App\SuratPindahKeluar;
use App\PindahKeluar;
use Carbon\Carbon;
use DB;
use App\Penduduk;
use App\KartuKeluarga;

class SuratPindahKeluarController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}

	public function insert() {
    	$penerbit = Penerbit::all();

    	return view('pindah_keluar.insert', compact('penerbit'));
    }

    public function store(Request $request) {
    	$this->validate(request(), [
            'penduduk_id' => 'required',
            'alamat_tujuan' => 'required',
            'alasan_pindah' => 'required',
            'penerbit_id' => 'required',
        ]);

        if (Penduduk::find(request('penduduk_id')) == null) {
            return back()->withErrors([
                'message' => 'NIK yang anda masukkan salah.'
            ]);
        }

        $cek = SuratPindahKeluar::latest()->first();
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

        $pindah = SuratPindahKeluar::create([
            'nomor' => $nomor_fix,
            'penduduk_id' => request('penduduk_id'),
            'alamat_tujuan' => strtoupper(request('alamat_tujuan')),
            'alasan_pindah' => strtoupper(request('alasan_pindah')),
            'penerbit_id' => request('penerbit_id'),
        ]);

        if ($request->has('nomor_kk')) {
            if (KartuKeluarga::find(request('nomor_kk')) == null) {
                return back()->withErrors([
                    'message' => 'Nomor KK yang anda masukkan salah.'
                ]);
            }
            $kk = KartuKeluarga::find(request('nomor_kk'));
            $data = $kk->get_penduduk;

            foreach ($data as $row) {
                $find = Penduduk::find($row->id);
                if ($find) {
                    $find->status = '2';
                    $find->save();

                    PindahKeluar::create([
                        'penduduk_id' => $row->id,
                        'surat_keluar_id' => $pindah->id,
                    ]);
                }
                else {
                    return back()->withErrors([
                        'message' => 'NIK yang anda masukkan salah.'
                    ]);
                }
            }

            $kk->status = '2';
            $kk->save();
        }
        else {
            $penduduk = Penduduk::find(request('penduduk_id'));
            $penduduk->status = '2';
            $penduduk->save();

            PindahKeluar::create([
                'penduduk_id' => $penduduk->id,
                'surat_keluar_id' => $pindah->id,
            ]);

            if (request('list_nik') !== null) {
                $list_nik = request('list_nik');
                $data = explode("," ,$list_nik);

                foreach ($data as $row) {
                    $find = Penduduk::find($row);
                    if ($find) {
                        $find->status = '2';
                        $find->save();

                        PindahKeluar::create([
                            'penduduk_id' => $row,
                            'surat_keluar_id' => $pindah->id,
                        ]);
                    }
                    else {
                        return back()->withErrors([
                            'message' => 'NIK yang anda masukkan salah.'
                        ]);
                    }
                }
            }
        }

        return redirect("/pindah_keluar/$pindah->id");
    }

    public function show_all(Request $request) {
    	$tahun_choose = "";
    	$bulan_choose = "";
    	$search_term = "";

    	$pindah = SuratPindahKeluar::with(['get_penduduk', 'get_penerbit']);

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
            $pindah = $pindah->orWhere('penduduk_id', "like", "%" . request('q'). "%")->orWhere('alasan_pindah', "like", "%" . request('q'). "%")->orWhere('alamat_tujuan', "like", "%" . request('q'). "%")->orWhere('nomor', "like", "%" . request('q'). "%");
            $search_term = request('q');
        }
        if ($request->has('page')) {
            $page_choose = (int) request('page');
        }
        else {
            $page_choose = 1;
        }

        $pindah_download = $pindah->get();
        $pindah = $pindah->paginate(15, ['*'], 'page', $page_choose);
    	
    	return view('pindah_keluar.show_all', compact('pindah', 'search_term', 'tahun_choose', 'bulan_choose', 'pindah_download'));
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
        $pdf->loadView('pindah_keluar.pdf', compact('surat', 'tahun_choose', 'bulan_choose', 'search_term'));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function show($id) {
    	$pindah = SuratPindahKeluar::with(['get_penerbit'])->find($id);
        $penduduk = Penduduk::with(['get_kk'])->find($pindah->penduduk_id);
        $pengikut = PindahKeluar::with('get_penduduk')->whereRaw('surat_keluar_id = ' . $id . ' and penduduk_id != ' . $penduduk->id)->get();
 
        return view('pindah_keluar.show', compact('pindah', 'penduduk', 'pengikut'));
    }

    public function edit($id) {
        $penerbit = Penerbit::all();
    	$pindah = SuratPindahKeluar::with(['get_penduduk', 'get_penerbit'])->find($id);
        $penduduk = Penduduk::with(['get_agama', 'get_tempat_lahir'])->find($pindah->get_penduduk->id);
    	return view('pindah_keluar.edit', compact('pindah', 'penerbit', 'penduduk'));
    }

    public function store_edit(SuratPindahKeluar $pindah, Request $request) {
    	$this->validate(request(), [
            'alamat_tujuan' => 'required',
            'alasan_pindah' => 'required',
            'penerbit_id' => 'required',
            'penduduk_id' => 'required',
    	]);

        $pindah->alamat_tujuan = strtoupper(request('alamat_tujuan'));
        $pindah->alasan_pindah = strtoupper(request('alasan_pindah'));
        $pindah->penerbit_id = strtoupper(request('penerbit_id'));
    	$pindah->save();

        $find = PindahKeluar::where('surat_keluar_id', $pindah->id)->get();
        foreach ($find as $key => $row) {
            $penduduk_ikut = Penduduk::find($row->penduduk_id);
            $penduduk_ikut->status = NULL;
            $penduduk_ikut->save();

            $row->delete();
        }

        if ($request->has('nomor_kk')) {
            if (KartuKeluarga::find(request('nomor_kk')) == null) {
                return back()->withErrors([
                    'message' => 'Nomor KK yang anda masukkan salah.'
                ]);
            }
            $kk = KartuKeluarga::find(request('nomor_kk'));
            $data = $kk->get_penduduk;

            foreach ($data as $row) {
                $find = Penduduk::find($row->id);
                if ($find) {
                    $find->status = '2';
                    $find->save();

                    PindahKeluar::create([
                        'penduduk_id' => $row->id,
                        'surat_keluar_id' => $pindah->id,
                    ]);
                }
                else {
                    return back()->withErrors([
                        'message' => 'NIK yang anda masukkan salah.'
                    ]);
                }
            }

            $kk->status = '2';
            $kk->save();
        }
        else {
            if (request('list_nik') !== null) {
                $list_nik = request('list_nik');
                $data = explode("," ,$list_nik);

                foreach ($data as $row) {
                    $find = Penduduk::find($row);
                    if ($find) {
                        $find->status = '2';
                        $find->save();

                        PindahKeluar::create([
                            'penduduk_id' => $row,
                            'surat_keluar_id' => $pindah->id,
                        ]);
                    }
                    else {
                        return back()->withErrors([
                            'message' => 'NIK yang anda masukkan salah.'
                        ]);
                    }
                }
            }

            PindahKeluar::create([
                'penduduk_id' => request('penduduk_id'),
                'surat_keluar_id' => $pindah->id,
            ]);

            $penduduk = Penduduk::find(request('penduduk_id'));
            $penduduk->status = '2';
            $penduduk->save();
        }

    	return redirect("/pindah_keluar/$pindah->id");
    }

    public function delete(SuratPindahKeluar $pindah) {
        $find = PindahKeluar::where('surat_keluar_id', $pindah->id)->get();
        foreach ($find as $key => $row) {
            $penduduk = Penduduk::find($row->penduduk_id);
            $penduduk->status = NULL;
            $penduduk->save();

            $kk = $penduduk->get_kk;
            $kk->status = NULL;
            $kk->save();

            $row->delete();
        }

    	$pindah->delete();
    	return redirect('/pindah_keluar');
    }

    public function print($id) {
        $surat = SuratPindahKeluar::with(['get_penduduk', 'get_penerbit'])->find($id);
        $penduduk = Penduduk::with(['get_status_nikah', 'get_jenis_pekerjaan', 'get_tempat_lahir'])->find($surat->penduduk_id);
        $penerbit = Penerbit::where('jabatan', 'KEPALA DESA')->first();
        $pengikut = PindahKeluar::with('get_penduduk')->whereRaw('surat_keluar_id = ' . $id . ' and penduduk_id != ' . $penduduk->id)->get();

        $pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('pindah_keluar.print', compact('surat', 'penduduk', 'penerbit', 'pengikut'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }

    public function stat_pindah_tahun(Request $request) {
        $data = [];
        $i = [0,0,0,0,0,0,0,0,0,0,0,0];

        if ($request->has('tahun')) {
            $count_month = SuratPindahKeluar::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . request('tahun'))->groupBy(DB::raw('month(created_at)'))->get();    
        }
        else {
            $now = Carbon::now();
            $count_month = SuratPindahKeluar::selectRaw('count(id) as count, month(created_at) as month')->orderByRaw('month(created_at)')->whereRaw('YEAR(created_at) = ' . $now->year)->groupBy(DB::raw('month(created_at)'))->get();
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
            $count_week = SuratPindahKeluar::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . request('tahun') . ' AND MONTH(created_at) = ' . request('bulan'))->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
        }
        else {
            $now = Carbon::now();
            $count_week = SuratPindahKeluar::selectRaw("FLOOR(((DAY(`created_at`) - 1) / 7) + 1) `week`, COUNT(`id`) AS `count`")->whereRaw('YEAR(created_at) = ' . $now->year . ' AND MONTH(created_at) = ' . $now->month)->groupBy('week')->orderByRaw("month(`created_at`), `week`")->get();
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
