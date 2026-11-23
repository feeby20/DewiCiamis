<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencairanDana extends Model
{
    use HasFactory;

    protected $table = 'pencairan_dana';

    protected $fillable = [
        'kode_pencairan',
        'desa_id',
        'pengelola_id',
        'nominal',
        'bank_tujuan',
        'nomor_rekening',
        'atas_nama',
        'status',
        'bukti_transfer',
        'catatan_admin',
        'tanggal_pengajuan',
        'tanggal_konfirmasi',
    ];

    protected $casts = [
        'nominal' => 'integer',
        'tanggal_pengajuan' => 'datetime',
        'tanggal_konfirmasi' => 'datetime',
    ];

    public function desa()
    {
        return $this->belongsTo(DesaWisata::class, 'desa_id');
    }

    public function pengelola()
    {
        return $this->belongsTo(PengelolaDesa::class, 'pengelola_id');
    }
}
