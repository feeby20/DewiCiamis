<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationPrice extends Model
{
    use HasFactory;

    protected $table = 'destination_prices';

    public $timestamps = false; // Only has updated_at

    protected $fillable = [
        'destination_name',
        'ticket_price',
        'updated_at',
    ];
}
