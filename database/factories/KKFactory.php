<?php

use Faker\Generator as Faker;

$factory->define(App\KK::class, function (Faker $faker) {
    return [
        'no_kk' => str_random(16),
        'kepala_keluarga' => 1,
        'alamat' => $faker->sentence,
        'rt' => 1,
        'rw' => 1,
        'kelurahan' => 1,
        'kecamatan' => 1,
        'kota' => 1,
        'kode_pos' => 65135,
        'provinsi' => 1,
        'tgl_terbit' => $faker->date,
        'penerbit' => 1,
    ];
});
