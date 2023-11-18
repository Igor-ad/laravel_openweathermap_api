<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class WeatherDataService
{
    public function getForecast(string $lat, string $lon): ?Collection
    {
        $forecast = Cache::store('redis')->get($this->setKey($lat, $lon));

        if (!$forecast) {
            $forecast = $this->currentByCord($lat, $lon);

            Cache::store('redis')->put(
                $this->setKey($lat, $lon),
                $forecast,
                config('services.open_weather.cache_time'),
            );
        }
        return $forecast;
    }

    private function setKey(string $lat, string $lon): string
    {
        return sprintf("%s%s%s_current", Auth::id(), $lat, $lon);
    }

    protected function currentByCord(string $lat, string $lon): ?Collection
    {
        return collect(WeatherFactory::create()->getCurrentByCord($lat, $lon));
    }
}
