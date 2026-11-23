<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesaWisata extends Model
{
    use HasFactory;

    protected $table = 'desa_wisata';

    protected $fillable = [
        'nama_desa',
        'slug',
        'kecamatan',
        'sk_bupati',
        'status_desa',
        'kategori',
        'destinasi_unggulan',
        'deskripsi',
        'gambar',
        'jam_buka',
        'hari_operasional',
        'harga_tiket',
        'nama_bank',
        'nomor_rekening',
        'atas_nama_rekening',
        'saldo_tersedia',
        'saldo_dicairkan',
    ];

    protected $casts = [
        'harga_tiket' => 'integer',
        'saldo_tersedia' => 'integer',
        'saldo_dicairkan' => 'integer',
    ];

    public function pengelola()
    {
        return $this->hasOne(PengelolaDesa::class, 'desa_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'desa_id');
    }

    public function pencairanDana()
    {
        return $this->hasMany(PencairanDana::class, 'desa_id');
    }
}
