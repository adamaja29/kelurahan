<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Warga extends Authenticatable
{
    protected $table = 'warga';

    protected $fillable = [
        'rt_id',
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
    ];

    public function rt()
    {
        return $this->belongsTo(rt::class, 'rt_id');
    }
}
