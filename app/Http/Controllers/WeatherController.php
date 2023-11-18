<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeatherController extends AbstractWeatherController
{
    use ResponseTrait;

    public function getWeather(Request $request): JsonResponse
    {
        $forecast = $this->getCurrentForecast($request);
        $user = Auth::user();

        return $this->collectionResponse(collect()
            ->put('user', $user)
            ->put('main', collect($forecast->get('main'))
                ->only(['temp', 'pressure', 'humidity', 'temp_max', 'temp_min'])
            )
        );
    }
}
