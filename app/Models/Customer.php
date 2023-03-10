<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'users';

    /**
     * Get the user record associated with the customer.
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function isCustomer()
    {
        return $this->userType->name === 'customers';
    }

    /**
     * Get the customer's bookings.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the customer's pets.
     */
    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
