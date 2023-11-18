<?php

declare(strict_types=1);

namespace App\Services;

use RakibDevs\Weather\Weather;

class WeatherFactory
{
    public static function create(): Weather
    {
        return new Weather();
    }
}
