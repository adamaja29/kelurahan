<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jenis_surat extends Model
{
    protected $table = 'jenis_surat';

    protected $fillable = [
        'nama',
        'kode_surat',
        'perlu_pengantar',
    ];
}
