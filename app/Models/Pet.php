<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'name',
        'species',
        'gender',
        'date_of_birth',
        'fur',
        'size',
        'microchip',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }

    public function dewormers()
    {
        return $this->hasMany(Dewormer::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
