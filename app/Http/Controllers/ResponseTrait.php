<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

trait ResponseTrait
{
    public function collectionResponse(array|Collection $collection, int $status = 200): JsonResponse
    {
        return response()->json(
            $collection,
            status: $status,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
