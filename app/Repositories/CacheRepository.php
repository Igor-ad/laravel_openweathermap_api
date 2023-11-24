<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CacheRepository
{
    public function get(string $key): ?Collection
    {
        return Cache::get($key);
    }

    public function set(string $key, Collection $collection, int $time = 600): void
    {
        Cache::put($key, $collection, $time);
    }
}
