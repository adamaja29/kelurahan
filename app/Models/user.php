<?php

namespace App\Models;

use App\Models\rt;
use App\Models\rw;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'rt_id',
        'rw_id',
    ];

    public function rt()
    {
        return $this->belongsTo(rt::class, 'rt_id');
    }

    public function rw()
    {
        return $this->belongsTo(rw::class, 'rw_id');
    }
}
