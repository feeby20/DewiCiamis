<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PengelolaDesa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pengelola_desa';

    protected $fillable = [
        'desa_id',
        'name',
        'username',
        'email',
        'password',
        'no_hp',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function desa()
    {
        return $this->belongsTo(DesaWisata::class, 'desa_id');
    }

    public function pencairanDana()
    {
        return $this->hasMany(PencairanDana::class, 'pengelola_id');
    }

    public function validatedOrders()
    {
        return $this->hasMany(Order::class, 'validated_by');
    }
}
