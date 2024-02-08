<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ForecastResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'user' => UserResource::make(Auth::user()),
            'main' => WeatherResource::make($this),
        ];
    }
}
