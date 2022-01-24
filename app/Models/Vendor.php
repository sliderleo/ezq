<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'nric',
        'contact'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
