<?php

Route::get('/', function () {
    return view('layout.index');
})->middleware('auth');

Route::get('/kk/stat', 'KartuKeluargaController@stat');
Route::get('/kk/stat_rw_warga_ajax', 'KartuKeluargaController@stat_rw_warga_ajax');
Route::get('/kk/stat_rw_keluarga_ajax', 'KartuKeluargaController@stat_rw_keluarga_ajax');
Route::get('/kk/stat_rt_warga_ajax', 'KartuKeluargaController@stat_rt_warga_ajax');
Route::get('/kk/stat_rt_keluarga_ajax', 'KartuKeluargaController@stat_rt_keluarga_ajax');

Route::get('/kk/insert', 'KartuKeluargaController@insert');
Route::post('/kk/download', 'KartuKeluargaController@getPdf');
Route::post('/kk', 'KartuKeluargaController@store');
Route::get('/kk', 'KartuKeluargaController@show_all');
Route::get('/kk/{kk}', 'KartuKeluargaController@show');
Route::get('/kk/{kk}/edit', 'KartuKeluargaController@edit');
Route::post('/kk/{kk}', 'KartuKeluargaController@store_edit');

Route::get('/rt/insert', 'RukunTetanggaController@insert');
Route::post('/rt', 'RukunTetanggaController@store');
Route::get('/rt', 'RukunTetanggaController@show_all');
Route::get('/rt/{rt}/edit', 'RukunTetanggaController@edit');
Route::post('/rt/{rt}', 'RukunTetanggaController@store_edit');

Route::get('/rw/insert', 'RukunWargaController@insert');
Route::post('/rw', 'RukunWargaController@store');
Route::get('/rw', 'RukunWargaController@show_all');
Route::get('/rw/{rw}/edit', 'RukunWargaController@edit');
Route::post('/rw/{rw}', 'RukunWargaController@store_edit');

Route::get('/kecamatan_ajax_hasil/{kecamatan}', 'KecamatanController@kecamatan_ajax_hasil');
Route::get('/kecamatan_ajax', 'KecamatanController@kecamatan_ajax');
Route::get('/penduduk_ajax_kota', 'PendudukController@penduduk_ajax_kota');
Route::get('/penduduk_ajax_nik', 'PendudukController@penduduk_ajax_nik');
Route::get('/penduduk_ajax_kematian', 'PendudukController@penduduk_ajax_kematian');
Route::get('/penduduk_ajax_nik_kepala', 'PendudukController@penduduk_ajax_nik_kepala');
Route::get('/rw_ajax/{rw}', 'KartuKeluargaController@rw_ajax');
Route::get('/kk/{kk}/keluarga_ajax', 'KartuKeluargaController@keluarga_ajax');

Route::post('/penduduk/download', 'PendudukController@getPdf');
Route::get('/penduduk/stat_agama_ajax', 'PendudukController@stat_agama_ajax');
Route::get('/penduduk/stat_status_nikah_ajax', 'PendudukController@stat_status_nikah_ajax');
Route::get('/penduduk/stat_jk_ajax', 'PendudukController@stat_jk_ajax');
Route::get('/penduduk/stat_usia_ajax', 'PendudukController@stat_usia_ajax');
Route::get('/penduduk/stat_pendidikan_ajax', 'PendudukController@stat_pendidikan_ajax');
Route::get('/penduduk/stat_jenis_pekerjaan_ajax', 'PendudukController@stat_jenis_pekerjaan_ajax');
Route::get('/penduduk/stat_status_hubungan_ajax', 'PendudukController@stat_status_hubungan_ajax');
Route::get('/penduduk/stat_kewarganegaraan_ajax', 'PendudukController@stat_kewarganegaraan_ajax');

Route::get('/penduduk/stat', 'PendudukController@stat');
Route::get('/penduduk/insert', 'PendudukController@insert');
Route::post('/penduduk', 'PendudukController@store');
Route::get('/penduduk', 'PendudukController@show_all');
Route::get('/penduduk/{penduduk}', 'PendudukController@show');
Route::get('/penduduk/{penduduk}/edit', 'PendudukController@edit');
Route::post('/penduduk/{penduduk}', 'PendudukController@store_edit');

Route::get('/penerbit/insert', 'PenerbitController@insert');
Route::post('/penerbit', 'PenerbitController@store');
Route::get('/penerbit', 'PenerbitController@show_all');
Route::get('/penerbit/{penerbit}/edit', 'PenerbitController@edit');
Route::get('/penerbit/{penerbit}/delete', 'PenerbitController@delete');
Route::post('/penerbit/{penerbit}', 'PenerbitController@store_edit');

Route::post('/kematian/download', 'KematianController@getPdf');
Route::get('/kematian/insert', 'KematianController@insert');
Route::post('/kematian', 'KematianController@store');
Route::get('/kematian', 'KematianController@show_all');
Route::get('/kematian/{kematian}/edit', 'KematianController@edit');
Route::post('/kematian/{kematian}', 'KematianController@store_edit');
Route::get('/kematian/{kematian}/delete', 'KematianController@delete');

Route::post('/pindah/download', 'PindahController@getPdf');
Route::get('/pindah/insert', 'PindahController@insert');
Route::post('/pindah', 'PindahController@store');
Route::get('/pindah', 'PindahController@show_all');
Route::get('/pindah/{pindah}/edit', 'PindahController@edit');
Route::post('/pindah/{pindah}', 'PindahController@store_edit');
Route::get('/pindah/{pindah}/delete', 'PindahController@delete');

Route::post('/sktm/download', 'SuratKeteranganTidakMampuController@getPdf');
Route::get('/sktm/{sktm}/download', 'SuratKeteranganTidakMampuController@print');
Route::get('/sktm/insert', 'SuratKeteranganTidakMampuController@insert');
Route::post('/sktm', 'SuratKeteranganTidakMampuController@store');
Route::get('/sktm', 'SuratKeteranganTidakMampuController@show_all');
Route::get('/sktm/{sktm}', 'SuratKeteranganTidakMampuController@show');
Route::get('/sktm/{sktm}/delete', 'SuratKeteranganTidakMampuController@delete');
Route::post('/sktm/{sktm}', 'SuratKeteranganTidakMampuController@store_edit');
Route::get('/sktm/{sktm}/edit', 'SuratKeteranganTidakMampuController@edit');
Route::get('/stat_sktm_tahun', 'SuratKeteranganTidakMampuController@stat_sktm_tahun');
Route::get('/stat_sktm_bulan', 'SuratKeteranganTidakMampuController@stat_sktm_bulan');

Route::post('/sku/download', 'SuratKeteranganUsahaController@getPdf');
Route::get('/sku/insert_bri', 'SuratKeteranganUsahaController@insert_bri');
Route::get('/sku/insert', 'SuratKeteranganUsahaController@insert');
Route::get('/sku/insert_jatim_mandiri', 'SuratKeteranganUsahaController@insert_jatim_mandiri');
Route::get('/sku/insert_domisili_usaha', 'SuratKeteranganUsahaController@insert_domisili_usaha');
Route::post('/sku', 'SuratKeteranganUsahaController@store');
Route::post('/sku/{sku}', 'SuratKeteranganUsahaController@store_edit');
Route::get('/sku/{sku}', 'SuratKeteranganUsahaController@show');
Route::get('/sku', 'SuratKeteranganUsahaController@show_all');
Route::get('/sku/{sku}/delete', 'SuratKeteranganUsahaController@delete');
Route::get('/sku/{sku}/edit/{jenis_surat}', 'SuratKeteranganUsahaController@edit');
Route::get('/sku/{sku}/download/{jenis_surat}', 'SuratKeteranganUsahaController@print');
Route::get('/sku/insert_domisili_usaha', 'SuratKeteranganUsahaController@insert_domisili_usaha');
Route::get('/stat_sku_tahun', 'SuratKeteranganUsahaController@stat_sku_tahun');
Route::get('/stat_sku_bulan', 'SuratKeteranganUsahaController@stat_sku_bulan');

Route::post('/skk/download', 'SuratKeteranganKehilanganController@getPdf');
Route::get('/skk/{skk}/download', 'SuratKeteranganKehilanganController@print');
Route::get('/skk/insert', 'SuratKeteranganKehilanganController@insert');
Route::post('/skk', 'SuratKeteranganKehilanganController@store');
Route::post('/skk/{skk}', 'SuratKeteranganKehilanganController@store_edit');
Route::get('/skk/{skk}', 'SuratKeteranganKehilanganController@show');
Route::get('/skk', 'SuratKeteranganKehilanganController@show_all');
Route::get('/skk/{skk}/delete', 'SuratKeteranganKehilanganController@delete');
Route::get('/skk/{skk}/edit', 'SuratKeteranganKehilanganController@edit');
Route::get('/stat_skk_tahun', 'SuratKeteranganKehilanganController@stat_skk_tahun');
Route::get('/stat_skk_bulan', 'SuratKeteranganKehilanganController@stat_skk_bulan');

Route::post('/skd/download', 'SuratKeteranganDukunController@getPdf');
Route::get('/skd/{skd}/download', 'SuratKeteranganDukunController@print');
Route::get('/skd/insert', 'SuratKeteranganDukunController@insert');
Route::post('/skd', 'SuratKeteranganDukunController@store');
Route::post('/skd/{skd}', 'SuratKeteranganDukunController@store_edit');
Route::get('/skd/{skd}', 'SuratKeteranganDukunController@show');
Route::get('/skd', 'SuratKeteranganDukunController@show_all');
Route::get('/skd/{skd}/delete', 'SuratKeteranganDukunController@delete');
Route::get('/skd/{skd}/edit', 'SuratKeteranganDukunController@edit');
Route::get('/stat_skd_tahun', 'SuratKeteranganDukunController@stat_skd_tahun');
Route::get('/stat_skd_bulan', 'SuratKeteranganDukunController@stat_skd_bulan');

Route::post('/skkb/download', 'SuratKeteranganKelakuanBaikController@getPdf');
Route::get('/skkb/{skkb}/download', 'SuratKeteranganKelakuanBaikController@print');
Route::get('/skkb/insert', 'SuratKeteranganKelakuanBaikController@insert');
Route::post('/skkb', 'SuratKeteranganKelakuanBaikController@store');
Route::post('/skkb/{skkb}', 'SuratKeteranganKelakuanBaikController@store_edit');
Route::get('/skkb/{skkb}', 'SuratKeteranganKelakuanBaikController@show');
Route::get('/skkb', 'SuratKeteranganKelakuanBaikController@show_all');
Route::get('/skkb/{skkb}/delete', 'SuratKeteranganKelakuanBaikController@delete');
Route::get('/skkb/{skkb}/edit', 'SuratKeteranganKelakuanBaikController@edit');
Route::get('/stat_skkb_tahun', 'SuratKeteranganKelakuanBaikController@stat_skkb_tahun');
Route::get('/stat_skkb_bulan', 'SuratKeteranganKelakuanBaikController@stat_skkb_bulan');

Route::post('/skwn/download', 'SuratKeteranganWaliNikahController@getPdf');
Route::get('/skwn/{skwn}/download', 'SuratKeteranganWaliNikahController@print');
Route::get('/skwn/insert', 'SuratKeteranganWaliNikahController@insert');
Route::post('/skwn', 'SuratKeteranganWaliNikahController@store');
Route::post('/skwn/{skwn}', 'SuratKeteranganWaliNikahController@store_edit');
Route::get('/skwn/{skwn}', 'SuratKeteranganWaliNikahController@show');
Route::get('/skwn', 'SuratKeteranganWaliNikahController@show_all');
Route::get('/skwn/{skwn}/delete', 'SuratKeteranganWaliNikahController@delete');
Route::get('/skwn/{skwn}/edit', 'SuratKeteranganWaliNikahController@edit');
Route::get('/stat_skwn_tahun', 'SuratKeteranganWaliNikahController@stat_skwn_tahun');
Route::get('/stat_skwn_bulan', 'SuratKeteranganWaliNikahController@stat_skwn_bulan');

Route::post('/sklp/download', 'SuratKeteranganLunasPbbController@getPdf');
Route::get('/sklp/{sklp}/download', 'SuratKeteranganLunasPbbController@print');
Route::get('/sklp/insert', 'SuratKeteranganLunasPbbController@insert');
Route::post('/sklp', 'SuratKeteranganLunasPbbController@store');
Route::post('/sklp/{sklp}', 'SuratKeteranganLunasPbbController@store_edit');
Route::get('/sklp/{sklp}', 'SuratKeteranganLunasPbbController@show');
Route::get('/sklp', 'SuratKeteranganLunasPbbController@show_all');
Route::get('/sklp/{sklp}/delete', 'SuratKeteranganLunasPbbController@delete');
Route::get('/sklp/{sklp}/edit', 'SuratKeteranganLunasPbbController@edit');
Route::get('/stat_sklp_tahun', 'SuratKeteranganLunasPbbController@stat_sklp_tahun');
Route::get('/stat_sklp_bulan', 'SuratKeteranganLunasPbbController@stat_sklp_bulan');

Route::post('/skkl/download', 'SuratKeteranganKenalLahirController@getPdf');
Route::get('/skkl/{skkl}/download', 'SuratKeteranganKenalLahirController@print');
Route::get('/skkl/insert', 'SuratKeteranganKenalLahirController@insert');
Route::post('/skkl', 'SuratKeteranganKenalLahirController@store');
Route::get('/skkl/{skkl}', 'SuratKeteranganKenalLahirController@show');
Route::get('/skkl', 'SuratKeteranganKenalLahirController@show_all');
Route::get('/skkl/{skkl}/delete', 'SuratKeteranganKenalLahirController@delete');
Route::get('/skkl/{skkl}/edit', 'SuratKeteranganKenalLahirController@edit');
Route::post('/skkl/{skkl}', 'SuratKeteranganKenalLahirController@store_edit');
Route::get('/stat_skkl_tahun', 'SuratKeteranganKenalLahirController@stat_skkl_tahun');
Route::get('/stat_skkl_bulan', 'SuratKeteranganKenalLahirController@stat_skkl_bulan');

Route::get('/login', 'SessionController@create');
Route::get('/ubah_pass', 'SessionController@ubah_pass');
Route::get('/logout', 'SessionController@logout');
Route::post('/session', 'SessionController@store');
Route::post('/session_pass', 'SessionController@store_pass');
Route::post('login', [ 'as' => 'login', 'uses' => 'SessionController@create']);