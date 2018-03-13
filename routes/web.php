<?php

Route::get('/', function () {
    return view('layout.index');
});

Route::get('/kk/insert', 'KartuKeluargaController@insert');
Route::post('/kk', 'KartuKeluargaController@store');

Route::get('/rt/insert', 'RukunTetanggaController@insert');
Route::post('/rt', 'RukunTetanggaController@store');

Route::get('/rw/insert', 'RukunWargaController@insert');
Route::post('/rw', 'RukunWargaController@store');

Route::get('/kecamatan_ajax_hasil/{kecamatan}', 'KecamatanController@kecamatan_ajax_hasil');
Route::get('/kecamatan_ajax', 'KecamatanController@kecamatan_ajax');
Route::get('/penduduk_ajax_kota', 'PendudukController@penduduk_ajax_kota');
Route::get('/penduduk_ajax_nik', 'PendudukController@penduduk_ajax_nik');

Route::get('/penduduk/insert', 'PendudukController@insert');
Route::post('/penduduk', 'PendudukController@store');