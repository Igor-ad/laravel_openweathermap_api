<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\WeatherResource;
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
            (string)$this->location->getGeoLocation()->get('city')
        );
    }

    public function getForecast(): array
    {
        $forecast = $this->getCurrentForecast()->get('main');
        $user = Auth::user();

        return [
            'user' => new UserResource($user),
            'main' => new WeatherResource($forecast),
        ];
    }

    abstract public function getWeather();
}
