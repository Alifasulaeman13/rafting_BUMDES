<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'jenis_order', 'assigned_operator_id', 'tgl_order', 'status', 'meta',
    ];

    protected $casts = [
        'tgl_order' => 'datetime',
        'meta' => 'array',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class, 'assigned_operator_id');
    }
}