<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'mobile', 'password', 'otp'];
    
    // Set Default Value
    protected $attributes = [
        'otp' => '0'
    ];
}