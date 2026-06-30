<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rt extends Model
{
    protected $table = 'rt';

    protected $fillable = [
        'rw_id',
        'nomor_rt',
    ];
}
