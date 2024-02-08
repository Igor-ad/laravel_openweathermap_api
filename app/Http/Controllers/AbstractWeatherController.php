<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ForecastResource;
use App\Services\GeoLocationService;
use App\Services\WeatherDataService;
use Illuminate\Support\Collection;

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
            (string)$this->location->getGeoLocation()->get('city')
        );
    }

    public function getForecast(): Collection
    {
        return collect(ForecastResource::make($this->getCurrentForecast()->get('main')));
    }

    abstract public function getWeather();
}
