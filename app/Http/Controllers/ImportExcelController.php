<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Penduduk;
use App\KartuKeluarga;
use App\RukunTetangga;
use App\RukunWarga;
use App\Kota;
use App\Agama;
use App\StatusNikah;
use App\StatusHubungan;
use App\Pendidikan;
use App\JenisPekerjaan;
use Carbon\Carbon;
use DB;
use App\Libraries\Spreadsheet_Excel_Reader;

class ImportExcelController extends Controller
{
    function insert() {
    	return view('import.insert');
    }

    /*function store(Request $request) {
    	$this->validate($request, [
    		'file'  => 'required|mimes:xls,xlsx'
    	]);

    	$data = new Spreadsheet_Excel_Reader($_FILES['filepegawai']['name'],false);
		// menghitung jumlah baris data yang ada
		$jumlah_baris = $data->rowcount($sheet_index=0);
    }*/

    function store(Request $request) {
    	$this->validate($request, [
    		'file'  => 'required|mimes:xls,xlsx'
    	]);

    	$path = $request->file('file')->getRealPath();

    	$data= Excel::load($path, function($reader) {
       		$reader->noHeading();
       		$reader->skipRows(6);
    	})->get();

    	$c_kk = 0;

    	if($data->count() > 0)
    	{
    		foreach($data->toArray() as $key => $value)
    		{
    				foreach($value as $i => $row)
	    			{
	    				//return $value[2];
	    				if ($row[0] == 'NO. KK') {
	    					$next = 'KK';
	    				}
	    				elseif ($row[0] == 'NO') {
	    					$next = "PEN";
	    				}
	    				else {
	    					if ($next == "KK") {
	    						$alamat = explode(',', $row[5]);
	    						if (count($alamat) >= 5) {
	    							$arr_rw = $alamat[2];
	    							$arr_rt = $alamat[1];

	    							if (count($alamat) > 5) {
		    							foreach($alamat as $value) {
		    								if(strpos($value, 'RW') !== false) {
		    									$arr_rw = $value;
		    								}
		    								else if(strpos($value, 'RT') !== false) {
		    									$arr_rt = $value;
		    								}
		    							}
	    							}

	    							$temp_rw = substr($arr_rw, strpos($arr_rw, ':') + 2);
	    							try {
	    								$rw = RukunWarga::whereRaw("nama like '%" . $temp_rw . "%'")->first()->id;
	    							}
	    							catch(\Exception $e) {
	    								$rw = null;
	    							}
		    						
		    						if ($rw != null) {
		    							$temp_rt = substr($arr_rt, strpos($arr_rt, ':') + 2);
		    							$rt = RukunTetangga::whereRaw("nama like '%" . $temp_rt . "%'")->first();
		    							if ($rt != null) {
		    								$rt = $rt->id;
		    							}
		    							else {
		    								$rt = NULL;
		    							}
		    						}
	    						}
	    						else {
	    							$rw = NULL;
	    							$rt = NULL;
	    						}

	    						$insert_kk[] = array(
						            'id' => $row[0],
						            'kepala_keluarga' => NULL,
						            'alamat' => strtoupper($alamat[0]),
						            'rukun_tetangga' => $rt,
						            'rukun_warga' => $rw,
						            'kelurahan' => '3507300003',
						            'kode_pos' => '65151',
						            'tgl_pengurusan' => '1900-01-01',
						            'created_at' => Carbon::now(),
						            'updated_at' => Carbon::now(),
						        );
						        $temp_kk = $row[0];
						        $c_kk += 1;
	    					}
	    					elseif ($next == 'PEN') {
	    						$tempat_lahir = Kota::where('nama', 'like', '%' . $row[4] . '%')->first();
	    						if ($tempat_lahir != NULL) $tempat_lahir = $tempat_lahir->id;
	    						else $tempat_lahir = 3573;

	    						$agama = Agama::where('keterangan', 'like', '%' . $row[6] . '%')->first();
	    						if ($agama != NULL) $agama = $agama->id;
	    						else $agama = NULL;

	    						$nikah = StatusNikah::where('keterangan', $row[8])->first();
	    						if ($nikah != NULL) $nikah = $nikah->id;
	    						else $nikah = NULL;

	    						$hubungan = StatusHubungan::where('keterangan', 'like', '%' . $row[9] . '%')->first();
	    						if ($hubungan != NULL) {
	    							$hubungan = $hubungan->id;
	    							if ($hubungan == 1) {
	    								$insert_kk[$c_kk - 1]['kepala_keluarga'] = $row[1];
	    							}
	    						}
	    						else $hubungan = NULL;

	    						$pendidikan = Pendidikan::where('keterangan', 'like', '%' . $row[10] . '%')->first();
	    						if ($pendidikan != NULL) $pendidikan = $pendidikan->id;
	    						else $pendidikan = NULL;

	    						$pekerjaan = JenisPekerjaan::where('keterangan', 'like', '%' . $row[11] . '%')->first();
	    						if ($pekerjaan != NULL) $pekerjaan = $pekerjaan->id;
	    						else $pekerjaan = NULL;

	    						$tgl_lahir = explode('/', $row[5]);
	    						if (count($tgl_lahir) != 3) {
	    							$tgl_lahir = array('01', '01', '1900');
	    						}

	    						if ($row[1] == NULL) {
	    							continue;
	    						}

	    						$insert_penduduk[] = array(
						    		'id' => $row[1],
						            'nama' => $row[2],
						    		'alamat_sebelumnya' => '-',
						    		'jk' => $row[3],
						    		'tempat_lahir' => $tempat_lahir,
						            'tgl_lahir' => $tgl_lahir[2] . '-' . $tgl_lahir[1] . '-' . $tgl_lahir[0],
						    		'agama_id' => $agama,
						            'status_nikah_id' => $nikah,
						            'status_hubungan_id' => $hubungan,
						    		'pendidikan_id' => $pendidikan,
						    		'jenis_pekerjaan_id' => $pekerjaan,
						    		'kewarganegaraan' => 'WNI',
						    		'nama_ayah' => strtoupper($row[13]),
						    		'nama_ibu' => strtoupper($row[12]),
						    		'kk_id' => $temp_kk,
						    		'created_at' => Carbon::now(),
						            'updated_at' => Carbon::now(),
						    	);
	    					}
	    				}
    				}
    		}
    		//return $insert_penduduk;

    		if(!empty($insert_kk))
    		{
    			foreach (array_chunk($insert_kk,1000) as $row)  
				{
					$exist = DB::table('kartu_keluargas')->find($row[0]);
					if ($exist == null) {
						DB::table('kartu_keluargas')->insert($row);
					}
				}

				foreach (array_chunk($insert_penduduk,1000) as $row)  
				{
					$exist = DB::table('penduduks')->find($row[0]);
					if ($exist == null) {
						DB::table('penduduks')->insert($row);
					}
				}
    		}
    	}
    	return redirect('/penduduk');
    }
}
