<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'user_id',
            'zip_code',
            'address',
            'number',
            'complement',
            'district',
            'city',
            'state',
        ];

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }
}
