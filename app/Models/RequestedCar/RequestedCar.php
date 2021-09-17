<?php

namespace App\Models\RequestedCar;

use Illuminate\Database\Eloquent\Model;

class RequestedCar extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'name',
        'phone',
        'email'
    ];
}
