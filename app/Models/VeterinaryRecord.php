<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VeterinaryRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'sevice_reference_id',
        'pet_id',
        'veterinarian_id',
        'date',
        'reason_for_visit',
        'diagnosis',
        'treatment',
        'prescribed_medications',
        'notes',
        'return_date',
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
