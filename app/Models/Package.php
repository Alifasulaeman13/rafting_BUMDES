<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'min_persons', 'max_persons', 
        'includes', 'requirements', 'is_active', 'image'
    ];

    protected $casts = [
        'price' => 'integer',
        'min_persons' => 'integer',
        'max_persons' => 'integer',
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}