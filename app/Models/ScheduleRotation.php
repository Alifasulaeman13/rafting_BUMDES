<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleRotation extends Model
{
    use HasFactory;

    protected $table = 'schedule_rotation';

    protected $fillable = [
        'pointer_index', 'last_assigned_operator_id',
    ];

    public function lastOperator()
    {
        return $this->belongsTo(Operator::class, 'last_assigned_operator_id');
    }
}