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

    protected $casts = [
        'perlu_pengantar' => 'boolean',
    ];

    public function suratPengantars()
    {
        return $this->hasMany(surat_pengantar::class, 'jenis_surat_id');
    }
}
