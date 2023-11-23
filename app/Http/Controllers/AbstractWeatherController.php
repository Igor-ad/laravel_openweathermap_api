<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GeoLocationService;
use App\Services\WeatherDataService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

abstract class AbstractWeatherController extends Controller
{
    public function __construct(
        protected WeatherDataService $weather,
        protected GeoLocationService $location,
    )
    {
    }

    public function getCurrentForecast(): ?Collection
    {
        return $this->weather->getForecast(
            (string)$this->location->getGeoLocation()->get('latitude'),
            (string)$this->location->getGeoLocation()->get('longitude'),
        );
    }

    public function getForecast(): Collection
    {
        $forecast = $this->getCurrentForecast();
        $user = Auth::user();

        return collect()
            ->put('user', $user)
            ->put('main', collect($forecast->get('main'))
                ->only(['temp', 'pressure', 'humidity', 'temp_max', 'temp_min'])
        );
    }

    abstract public function getWeather();
}
