<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractWeatherController;
use App\Http\Controllers\ResponseTrait;
use Illuminate\Http\JsonResponse;

class WeatherController extends AbstractWeatherController
{
    use ResponseTrait;

    public function getWeather(): JsonResponse
    {
        return $this->collectionResponse($this->getForecast());
    }
}
