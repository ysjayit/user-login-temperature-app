<?php

namespace App\Interfaces;

interface UserLoginTemperatureRepositoryInterface 
{
    public function createUserLoginTemperature(array $temperatureDetails);
    public function getUserWiseLoginTemperaturesGroupByCity();
}
