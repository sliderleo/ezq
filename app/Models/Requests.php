<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'store_name',
        'desc',
        'contact',
        'address',
        'emai',
        'contact'
    ];
}
