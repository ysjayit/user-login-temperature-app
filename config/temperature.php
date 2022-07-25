<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Temperature Capturing Settings
    |--------------------------------------------------------------------------
    |
    | This option controls the settings for capturing temperature of cities
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Number of cities configured for temperature capture
    |--------------------------------------------------------------------------
    */
    'no_of_cities'           => env('NO_OF_CITIES', 0),


    /*
    |--------------------------------------------------------------------------
    | Configuration of each city by json
    |--------------------------------------------------------------------------
    */
    'city_1'                 => env('CITY_1', ""),
    'city_2'                 => env('CITY_2', ""),
    

    /*
    |--------------------------------------------------------------------------
    | Configuration of Open Weather Map API Key
    |--------------------------------------------------------------------------
    */
    'openweathermap_api_key' => env('OPENWEATHERMAP_API_Key', "NOAPPID")

    
];

