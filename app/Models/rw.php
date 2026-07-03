<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rw extends Model
{
    protected $table = 'rw';

    protected $fillable = [
        'nomor_rw',
        'nama_wilayah'
    ];
}
