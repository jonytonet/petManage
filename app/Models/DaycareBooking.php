<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaycareBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'daycare_enrollment_id',
        'date',
        'entry_time',
        'exit_time',
        'extra_time',
        'notes',
    ];

    public function daycareEnrollment()
    {
        return $this->belongsTo(DaycareEnrollment::class);
    }
}
