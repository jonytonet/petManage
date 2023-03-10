<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dewormer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sevice_reference_id',
        'pet_id',
        'veterinarian_id',
        'given_date',
        'weight',
        'medication',
        'reinforcement_date',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class);
    }
}
