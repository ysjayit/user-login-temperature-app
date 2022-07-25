<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Pool;

trait TemperatureTrait {

    // temperature conversions (from Kelvin)
    public function temperatureConversion ($temperature, $conversion) {

        switch ($conversion) {
            case 'KtoF':
                $fahrenheit = 9/5 * ($temperature - 273.15) + 32;
                return $fahrenheit;
                break;
            case 'KtoC':
                $celsius = $temperature - 273.15;
                return $celsius;
                break;
            default:
                return $temperature;
                break;
        }

    }

    // get city details from json configured
    public function getCityDetails ($cityNo) {
        $cityDetails = json_decode(config("temperature.city_".$cityNo));
        return $cityDetails;
    }

    // get current weather details of city from API
    public function getWeatherDetails () {

        $noOfCities = config("temperature.no_of_cities");

        $requestFunction = function (Pool $pool) use ($noOfCities) {

            for ($i=1; $i <= $noOfCities; $i++) {
                $cityDetails = $this->getCityDetails($i);
                $requestPools[] = $pool->as($cityDetails->name)->get('https://api.openweathermap.org/data/2.5/onecall', [
                    'lat' => $cityDetails->lat,
                    'lon' => $cityDetails->lon,
                    'exclude' => 'minutely,hourly,daily,alerts',
                    'appid' => config("temperature.openweathermap_api_key")
                ]);
            }
            return $requestPools;
        };

        $responses = Http::pool($requestFunction);
        return $responses;

    }

    // get wheather details of cities
    public function getWeatherDetailsOfCities () {
        
        try {

            $currentWheatherDetails = $this->getWeatherDetails();

            $temperatures = array();

            foreach ($currentWheatherDetails as $city => $details) {
                
                $cityDetails = json_decode($details);
                
                if (isset($cityDetails->current->temp)) {
                    $temperatures[] = [
                        'city' => $city,
                        'fahrenheit' => $this->temperatureConversion($cityDetails->current->temp, 'KtoF'),
                        'celsius' => $this->temperatureConversion($cityDetails->current->temp, 'KtoC'),
                        'record_date' => date('Y-m-d H:i:s')
                    ];
                }

            }

            return $temperatures;

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }



}