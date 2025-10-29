<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RescueMember extends Model
{
    use HasFactory;

    protected $table = 'rescue_team';

    protected $fillable = [
        'user_id', 'nama', 'telepon', 'status_oncall',
    ];

    protected $casts = [
        'status_oncall' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}