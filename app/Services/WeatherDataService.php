<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\CacheRepository;
use Illuminate\Support\Collection;

class WeatherDataService
{
    public function __construct(
        protected CacheRepository $repository
    )
    {
    }

    public function getForecast(string $city): ?Collection
    {
        $key = $this->setKey($city);

        $forecast = $this->repository->get($key);

        if (!$forecast) {
            $forecast = $this->currentByCity($city);

            $this->repository->set($key, $forecast, (int)config('services.open_weather.cache_time'));
        }
        return $forecast;
    }

    private function setKey(string $city): string
    {
        return sprintf("%s_current", $city);
    }

    protected function currentByCity(string $city): ?Collection
    {
        return collect(WeatherFactory::create()->getCurrentByCity($city));
    }
}
