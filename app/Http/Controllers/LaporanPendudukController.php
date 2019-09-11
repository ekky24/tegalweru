<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\LaporanPenduduk;
use App\Penduduk;
use App\SuratKeteranganDukun;
use App\Kematian;
use App\SuratPindahMasuk;
use App\SuratPindahKeluar;
use App\PindahMasuk;
use App\PindahKeluar;
use App\Penerbit;
use App\RukunTetangga;
use App\RukunWarga;
use App\KartuKeluarga;
use Carbon\Carbon;

class LaporanPendudukController extends Controller
{
    public function __construct() {
		return $this->middleware('auth');
	}

    public function insert() {
        return view('laporan.insert');
    }

	public function show_all(Request $request) {
    	$laporan = new LaporanPenduduk();
        $laporan_download = $laporan->get();
        $laporan = $laporan->orderBy('laporan_bulan', 'desc')->paginate(15);
    	
    	return view('laporan.show_all', compact('laporan', 'laporan_download'));
    }

    public function store() {
        $this->validate(request(), [
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $tahun = request('tahun');
        $bulan = request('bulan');
        $laporan = LaporanPenduduk::where('laporan_bulan', '<', $tahun . '-' . $bulan . '-01')->orderBy('created_at', 'desc')->first();
        if ($laporan != null) {
            $penduduk_awal_l = $laporan->penduduk_akhir_l;
            $penduduk_awal_p = $laporan->penduduk_akhir_p;
        }
        else {
            $penduduk_awal_l = Penduduk::where('jk', 'L')->get()->count();
            $penduduk_awal_p = Penduduk::where('jk', 'P')->get()->count();
        }

        $lahir_l = SuratKeteranganDukun::where('jk_anak', 'L');
        $lahir_p = SuratKeteranganDukun::where('jk_anak', 'P');
        $mati_l = Kematian::join('penduduks', 'penduduks.id', '=', 'kematians.penduduk_id')->where('penduduks.jk', 'L');
        $mati_p = Kematian::join('penduduks', 'penduduks.id', '=', 'kematians.penduduk_id')->where('penduduks.jk', 'P');

        $pindah_masuk_l = 0;
        $pindah_masuk_p = 0;
        $temp_pindah_masuk = SuratPindahMasuk::whereRaw('YEAR(created_at) = ' . $tahun)->whereRaw('MONTH(created_at) = ' . $bulan)->get();

        foreach ($temp_pindah_masuk as $key => $row) {
            $pindah_masuk = PindahMasuk::where('surat_masuk_id', $row->id)->get();
            foreach ($pindah_masuk as $key => $row2) {
                $temp_penduduk = Penduduk::find($row2->penduduk_id);
                if ($temp_penduduk->jk == 'L') {
                    $pindah_masuk_l += 1;
                }
                else {
                    $pindah_masuk_p += 1;
                }
            }
        }

        $pindah_keluar_l = 0;
        $pindah_keluar_p = 0;
        $temp_pindah_keluar = SuratPindahKeluar::whereRaw('YEAR(created_at) = ' . $tahun)->whereRaw('MONTH(created_at) = ' . $bulan)->get();

        foreach ($temp_pindah_keluar as $key => $row) {
            $pindah_keluar = PindahKeluar::where('surat_keluar_id', $row->id)->get();
            foreach ($pindah_keluar as $key => $row2) {
                $temp_penduduk = Penduduk::find($row2->penduduk_id);
                if ($temp_penduduk->jk == 'L') {
                    $pindah_keluar_l += 1;
                }
                else {
                    $pindah_keluar_p += 1;
                }
            }
        }
        
        $lahir_l = $lahir_l->whereRaw('YEAR(created_at) = ' . $tahun)->whereRaw('MONTH(created_at) = ' . $bulan)->get()->count();
        $lahir_p = $lahir_p->whereRaw('YEAR(created_at) = ' . $tahun)->whereRaw('MONTH(created_at) = ' . $bulan)->get()->count();
        $mati_l = $mati_l->whereRaw('YEAR(kematians.created_at) = ' . $tahun)->whereRaw('MONTH(kematians.created_at) = ' . $bulan)->get()->count();
        $mati_p = $mati_p->whereRaw('YEAR(kematians.created_at) = ' . $tahun)->whereRaw('MONTH(kematians.created_at) = ' . $bulan)->get()->count();

        $penduduk_akhir_l = $penduduk_awal_l + $lahir_l - $mati_l + $pindah_masuk_l - $pindah_keluar_l;
        $penduduk_akhir_p = $penduduk_awal_p + $lahir_p - $mati_p + $pindah_masuk_p - $pindah_keluar_p;
        $laporan_bulan = Carbon::createFromFormat('Y-m-d', $tahun . '-' . $bulan . '-01');

        $rt = RukunTetangga::all()->count();
        $rw = RukunWarga::all()->count();
        $kk = KartuKeluarga::getAktif()->count();

        LaporanPenduduk::create([
            'lahir_l' => $lahir_l,
            'lahir_p' => $lahir_p,
            'mati_l' => $mati_l,
            'mati_p' => $mati_p,
            'pindah_masuk_l' => $pindah_masuk_l,
            'pindah_masuk_p' => $pindah_masuk_p,
            'pindah_keluar_l' => $pindah_keluar_l,
            'pindah_keluar_p' => $pindah_keluar_p,
            'penduduk_akhir_l' => $penduduk_akhir_l,
            'penduduk_akhir_p' => $penduduk_akhir_p,
            'laporan_bulan' => $laporan_bulan,
            'rt' => $rt,
            'rw' => $rw,
            'kk' => $kk,
        ]);

        return redirect('/laporan_penduduk');
    }

    public function download(LaporanPenduduk $laporan) {
        $penerbit = Penerbit::where('jabatan', 'KEPALA DESA')->first();
        $laporan_lama = LaporanPenduduk::where('laporan_bulan', '<', $laporan->laporan_bulan)->orderBy('created_at', 'desc')->first();

        if ($laporan_lama != null) {
            $penduduk_awal_l = $laporan_lama->penduduk_akhir_l;
            $penduduk_awal_p = $laporan_lama->penduduk_akhir_p;
        }
        else {
            $penduduk_awal_l = Penduduk::where('jk', 'L')->get()->count();
            $penduduk_awal_p = Penduduk::where('jk', 'P')->get()->count();
        }

        $pdf = App::make('dompdf.wrapper'); 
        $pdf->loadView('laporan.download', compact('laporan', 'penduduk_awal_l', 'penduduk_awal_p', 'penerbit'));
        $pdf->setPaper('legal', 'landscape');
        return $pdf->stream();
    }

    public function delete(LaporanPenduduk $laporan) {
        $laporan->delete();
        return redirect('/laporan_penduduk');
    }
}
