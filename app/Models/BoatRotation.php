<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatRotation extends Model
{
    use HasFactory;

    protected $table = 'boat_rotation';

    protected $fillable = [
        'pointer_index', 'last_assigned_boat_id',
    ];

    public function lastBoat()
    {
        return $this->belongsTo(Boat::class, 'last_assigned_boat_id');
    }
}