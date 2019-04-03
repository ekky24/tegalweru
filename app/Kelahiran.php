<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    protected $fillable = ['nama', 'jk', 'tempat_lahir', 'tgl_lahir', 'surat_lahir_id'];
}
