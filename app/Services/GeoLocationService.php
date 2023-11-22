<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;
use MakiDizajnerica\GeoLocation\Facades\GeoLocation;

class GeoLocationService
{
    protected final const GOOGLE_DNS = '8.8.8.8';

    public function getGeoLocation(): Collection
    {
        return GeoLocation::lookup($this->validateGlobalIpAddress());
    }

    protected function validateGlobalIpAddress(): string
    {
        if ((filter_var(request()->ip(), FILTER_VALIDATE_IP, FILTER_FLAG_NO_RES_RANGE))
            && (filter_var(request()->ip(), FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE))) {
            return request()->ip();
        } else {
            return self::GOOGLE_DNS;
        }
    }
}
