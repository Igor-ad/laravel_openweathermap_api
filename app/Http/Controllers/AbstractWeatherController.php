<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\WeatherDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use MakiDizajnerica\GeoLocation\Facades\GeoLocation;

abstract class AbstractWeatherController extends Controller
{
    public function __construct(
        protected WeatherDataService $service,
    )
    {
    }

    public function getCurrentForecast(Request $request): ?Collection
    {
        $location = GeoLocation::lookup('8.8.8.8'); // You might use test IP address for works in local network
//        $location = GeoLocation::lookup($request->ip()); // Use Real IP address

        return $this->service->getForecast(
            (string)$location->get('latitude'),
            (string)$location->get('longitude'),
        );
    }

    abstract public function getWeather(Request $request);
}
