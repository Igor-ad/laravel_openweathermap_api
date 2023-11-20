<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class WeatherCacheRepository
{
    public function get(string $key): ?Collection
    {
        return Cache::store('redis')->get($key);
    }

    public function set(string $key, Collection $collection, int $time = 600): void
    {
        Cache::store('redis')->put($key, $collection, $time);
    }
}
