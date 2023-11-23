<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AbstractWeatherController;
use Illuminate\View\View;

class WeatherController extends AbstractWeatherController
{
    public function getWeather(): View
    {
        $data = json_encode($this->getForecast(),JSON_PRETTY_PRINT);

        return view('weather.current_forecast', compact('data'));
    }
}
