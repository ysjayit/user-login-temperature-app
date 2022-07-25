<?php

namespace App\Repositories;

use App\Interfaces\UserLoginTemperatureRepositoryInterface;
use App\Models\UserLoginTemperature;
use Auth;
use Illuminate\Support\Facades\DB;

class UserLoginTemperatureRepository implements UserLoginTemperatureRepositoryInterface 
{

    // create user login temperature
    public function createUserLoginTemperature(array $temperatureDetails) 
    {

        DB::transaction(function () use ($temperatureDetails) {
            UserLoginTemperature::create($temperatureDetails);
        });

    }

    // get user login temperature by city
    public function getUserWiseLoginTemperaturesGroupByCity()
    {

        $result = UserLoginTemperature::where('user_id', Auth::id())->get();
        return $result->groupBy('city');

    }

    
}
