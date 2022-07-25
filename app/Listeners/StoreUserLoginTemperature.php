<?php

namespace App\Listeners;

use App\Events\LoginTemperature;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Traits\TemperatureTrait;
use App\Interfaces\UserLoginTemperatureRepositoryInterface;
use Auth;

class StoreUserLoginTemperature
{

    private UserLoginTemperatureRepositoryInterface $temperatureRepository;
    use TemperatureTrait;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserLoginTemperatureRepositoryInterface $temperatureRepository)
    {
        $this->temperatureRepository = $temperatureRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LoginTemperature  $event
     * @return void
     */
    public function handle(LoginTemperature $event)
    {
        
        // get wheather details of cities
        $temperatureDetails = $this->getWeatherDetailsOfCities();

        if (is_array($temperatureDetails)) {
            foreach ($temperatureDetails as $cityDetails) {
                $temperatureData = [
                    'user_id'       => Auth::id(),
                    'city'          => $cityDetails['city'],
                    'fahrenheit'    => $cityDetails['fahrenheit'],
                    'celsius'       => $cityDetails['celsius'],
                    'record_date'   => $cityDetails['record_date']
                ];
                // save login temperature of user by city
                $this->temperatureRepository->createUserLoginTemperature($temperatureData);
            }
        }

    }


}
