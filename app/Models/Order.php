<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public $timestamps = true;
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'desa_id',
        'booking_code',
        'full_name',
        'whatsapp',
        'destination_name',
        'visit_date',
        'ticket_qty',
        'ticket_price',
        'total_price',
        'payment_status',
        'payment_proof',
        'ticket_status',
        'validated_at',
        'validated_by',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'ticket_qty' => 'integer',
        'ticket_price' => 'integer',
        'total_price' => 'integer',
        'validated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function desa()
    {
        return $this->belongsTo(DesaWisata::class, 'desa_id');
    }

    public function validator()
    {
        return $this->belongsTo(PengelolaDesa::class, 'validated_by');
    }
}
