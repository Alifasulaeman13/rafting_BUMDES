<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'package_id',
        // Lama
        'tgl_booking', 'jumlah_orang', 'total', 'metode_pembayaran', 'status_pembayaran', 'invoice_code', 'lat', 'lng', 'meta',
        // Baru (alur booking publik)
        'schedule_date', 'scheduled_at', 'number_of_persons', 'total_price', 'status', 'payment_status', 'boat_id', 'boatman_id',
    ];

    protected $casts = [
        'tgl_booking' => 'date',
        'total' => 'decimal:2',
        'meta' => 'array',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7',
        // Baru (alur booking publik)
        'schedule_date' => 'datetime',
        'scheduled_at' => 'datetime',
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}