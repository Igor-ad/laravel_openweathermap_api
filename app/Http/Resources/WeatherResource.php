<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'temp'            => $this->temp,
            'pressure'        => $this->pressure,
            'humidity'        => $this->humidity,
            'temp_min'        => $this->temp_min,
            'temp_max'        => $this->temp_max,
        ];
    }
}
