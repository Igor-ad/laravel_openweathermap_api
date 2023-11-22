<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AbstractWeatherController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WeatherController extends AbstractWeatherController
{
    public function getWeather(Request $request): View
    {
        $data = json_encode($this->getForecast($request),JSON_PRETTY_PRINT);

        return view('weather.current_forecast', compact('data'));
    }
}
