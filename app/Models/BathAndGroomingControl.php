<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BathAndGroomingControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'sevice_reference_id',
        'pet_id',
        'bath_and_grooming_plan_id',
        'user_id',
        'bath_date',
        'bath_time',
        'baths_number_plan',
        'baths_number_used',
        'extra_services',
        'notes',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function bathAndGroomingPlan()
    {
        return $this->belongsTo(BathAndGroomingPlan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
