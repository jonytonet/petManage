<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaycareEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'sevice_reference_id',
        'daycare_plan_id',
        'initial_date_plan',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function daycarePlan()
    {
        return $this->belongsTo(DaycarePlan::class);
    }
}
