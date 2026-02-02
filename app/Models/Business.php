<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category',
        'phone',
        'address',
        'logo',
    ];

    // Optional: hide sensitive info
    protected $hidden = ['user_id'];
}
