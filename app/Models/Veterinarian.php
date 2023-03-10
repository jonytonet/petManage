<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'qualification',
        'crmv',
        'user_id',
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
