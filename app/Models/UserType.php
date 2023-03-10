<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'permissions'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getPermissionsAttribute()
    {
        return json_decode($this->attributes['permissions'], true);
    }
}
