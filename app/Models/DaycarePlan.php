<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaycarePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'days',
        'sessions_per_week',
        'session_type',
        'price',
    ];

    public function daycareEnrollments()
    {
        return $this->hasMany(DaycareEnrollment::class);
    }
}
