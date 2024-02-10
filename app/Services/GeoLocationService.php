<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;
use MakiDizajnerica\GeoLocation\Facades\GeoLocation;

/*
 * If you are using the test application on a local network,
 * your local IP address will be changed to a Google DNS IP address = '8.8.8.8'
 */

class GeoLocationService
{
    protected final const GOOGLE_DNS = '8.8.8.8';

    public function getGeoLocation(): Collection
    {
        return GeoLocation::lookup($this->validateGlobalIpAddress());
    }

    /*
     * Checking an address to see if it belongs to the global range,
     * or returning the Google DNS address
     */
    protected function validateGlobalIpAddress(): string
    {
        return filter_var(
            request()->ip(),
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        )
            ? request()->ip() : self::GOOGLE_DNS;
    }
}
