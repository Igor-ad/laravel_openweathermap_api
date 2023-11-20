<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\WeatherCacheRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class WeatherDataService
{

    public function __construct(
        protected WeatherCacheRepository $repository
    )
    {
    }

    public function getForecast(string $lat, string $lon): ?Collection
    {
        $key = $this->setKey($lat, $lon);

        $forecast = $this->repository->get($key);

        if (!$forecast) {
            $forecast = $this->currentByCord($lat, $lon);

            $this->repository->set($key, $forecast, (int)config('services.open_weather.cache_time'));
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
