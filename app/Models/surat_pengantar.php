<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\jenis_surat;
use App\Models\Warga;

class surat_pengantar extends Model
{
    protected $table = 'surat_pengantar';

    protected $fillable = [
        'warga_id',
        'jenis_surat_id',
        'nomor_surat',
        'data_pengajuan',
        'status',
        'catatan',
        'file_surat',
    ];

    protected $casts = [
        'data_pengajuan' => 'array',
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(jenis_surat::class, 'jenis_surat_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
