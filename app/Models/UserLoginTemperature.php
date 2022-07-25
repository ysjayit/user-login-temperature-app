<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginTemperature extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'city', 'fahrenheit', 'celsius', 'record_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'record_date' => 'datetime:l, j  F Y, h:i A',
        'fahrenheit'  => 'integer',
        'celsius'     => 'integer',
    ];


}
