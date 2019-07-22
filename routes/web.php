<?php

Route::get('/', function() {
	if (auth()->check()) {
        return view('layout.index');
     }
     else {
         return redirect('/penduduk/stat');
     }
});

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
Route::get('/penduduk/stat_status_ajax', 'PendudukController@stat_status_ajax');

Route::get('/penduduk/stat', 'PendudukController@stat');
Route::get('/penduduk/stat/download', 'PendudukController@stat_download');
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
Route::get('/kematian/{kematian}/download', 'KematianController@print');
Route::get('/kematian/{kematian}', 'KematianController@show');
Route::post('/kematian', 'KematianController@store');
Route::get('/kematian', 'KematianController@show_all');
Route::get('/kematian/{kematian}/edit', 'KematianController@edit');
Route::post('/kematian/{kematian}', 'KematianController@store_edit');
Route::get('/kematian/{kematian}/delete', 'KematianController@delete');
Route::get('/stat_kematian_tahun', 'KematianController@stat_kematian_tahun');
Route::get('/stat_kematian_bulan', 'KematianController@stat_kematian_bulan');

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
Route::post('/skd/download', 'SuratKeteranganDukunController@getPdf');
Route::get('/skd/{skd}/daftar_penduduk', 'SuratKeteranganDukunController@daftar_penduduk');
Route::post('/skd/{skd}/daftar_penduduk', 'SuratKeteranganDukunController@store_daftar_penduduk');
Route::get('/stat_skd_tahun', 'SuratKeteranganDukunController@stat_skd_tahun');
Route::get('/stat_skd_bulan', 'SuratKeteranganDukunController@stat_skd_bulan');

Route::post('/sik/download', 'SuratIjinKeramaianController@getPdf');
Route::get('/sik/{sik}/download', 'SuratIjinKeramaianController@print');
Route::get('/sik/insert', 'SuratIjinKeramaianController@insert');
Route::post('/sik', 'SuratIjinKeramaianController@store');
Route::post('/sik/{sik}', 'SuratIjinKeramaianController@store_edit');
Route::get('/sik/{sik}', 'SuratIjinKeramaianController@show');
Route::get('/sik', 'SuratIjinKeramaianController@show_all');
Route::get('/sik/{sik}/delete', 'SuratIjinKeramaianController@delete');
Route::get('/sik/{sik}/edit', 'SuratIjinKeramaianController@edit');
Route::get('/stat_sik_tahun', 'SuratIjinKeramaianController@stat_sik_tahun');
Route::get('/stat_sik_bulan', 'SuratIjinKeramaianController@stat_sik_bulan');

Route::post('/skdom/download', 'SuratDomisiliController@getPdf');
Route::get('/skdom/{skdom}/download', 'SuratDomisiliController@print');
Route::get('/skdom/insert', 'SuratDomisiliController@insert');
Route::post('/skdom', 'SuratDomisiliController@store');
Route::post('/skdom/{skdom}', 'SuratDomisiliController@store_edit');
Route::get('/skdom/{skdom}', 'SuratDomisiliController@show');
Route::get('/skdom', 'SuratDomisiliController@show_all');
Route::get('/skdom/{skdom}/delete', 'SuratDomisiliController@delete');
Route::get('/skdom/{skdom}/edit', 'SuratDomisiliController@edit');
Route::get('/stat_skdom_tahun', 'SuratDomisiliController@stat_skdom_tahun');
Route::get('/stat_skdom_bulan', 'SuratDomisiliController@stat_skdom_bulan');

Route::post('/pindah_masuk/download', 'SuratPindahMasukController@getPdf');
Route::get('/pindah_masuk/{pindah}/download', 'SuratPindahMasukController@print');
Route::get('/pindah_masuk/insert', 'SuratPindahMasukController@insert');
Route::post('/pindah_masuk', 'SuratPindahMasukController@store');
Route::post('/pindah_masuk/{pindah}', 'SuratPindahMasukController@store_edit');
Route::post('/insert_penduduk/{pindah}', 'SuratPindahMasukController@insert_penduduk');
Route::get('/pindah_masuk/{pindah}', 'SuratPindahMasukController@show');
Route::get('/pindah_masuk', 'SuratPindahMasukController@show_all');
Route::get('/pindah_masuk/{pindah}/delete', 'SuratPindahMasukController@delete');
Route::get('/pindah_masuk/{pindah}/edit', 'SuratPindahMasukController@edit');
Route::get('/stat_pindah_masuk_tahun', 'SuratPindahMasukController@stat_pindah_tahun');
Route::get('/stat_pindah_masuk_bulan', 'SuratPindahMasukController@stat_pindah_bulan');

Route::post('/pindah_keluar/download', 'SuratPindahKeluarController@getPdf');
Route::get('/pindah_keluar/{pindah}/download', 'SuratPindahKeluarController@print');
Route::get('/pindah_keluar/insert', 'SuratPindahKeluarController@insert');
Route::post('/pindah_keluar', 'SuratPindahKeluarController@store');
Route::post('/pindah_keluar/{pindah}', 'SuratPindahKeluarController@store_edit');
Route::get('/pindah_keluar/{pindah}', 'SuratPindahKeluarController@show');
Route::get('/pindah_keluar', 'SuratPindahKeluarController@show_all');
Route::get('/pindah_keluar/{pindah}/delete', 'SuratPindahKeluarController@delete');
Route::get('/pindah_keluar/{pindah}/edit', 'SuratPindahKeluarController@edit');
Route::get('/stat_pindah_keluar_tahun', 'SuratPindahKeluarController@stat_pindah_tahun');
Route::get('/stat_pindah_keluar_bulan', 'SuratPindahKeluarController@stat_pindah_bulan');

Route::get('/laporan_penduduk', 'LaporanPendudukController@show_all');
Route::post('/laporan_penduduk', 'LaporanPendudukController@store');
Route::get('/laporan_penduduk/{laporan}/delete', 'LaporanPendudukController@delete');
Route::get('/laporan_penduduk/{laporan}/download', 'LaporanPendudukController@download');
Route::get('/laporan_penduduk/insert', 'LaporanPendudukController@insert');

Route::get('/login', 'SessionController@create');
Route::get('/ubah_pass', 'SessionController@ubah_pass');
Route::get('/logout', 'SessionController@logout');
Route::post('/session', 'SessionController@store');
Route::post('/session_pass', 'SessionController@store_pass');
Route::post('login', [ 'as' => 'login', 'uses' => 'SessionController@create']);