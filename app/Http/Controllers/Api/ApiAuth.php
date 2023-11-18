<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;

trait ApiAuth
{
    use ResponseTrait;
    protected function tokenUpdate(?User $user): string
    {
        $token = $user->createToken('api_token')->plainTextToken;
        $user->timestamps = false;
        $user->update(['api_token' => $token]);

        return $token;
    }

    protected function response(?User $user, string $token, int $status): JsonResponse
    {
        return $this->collectionResponse([
            'user' => $user,
            'token' => $token
        ],
            $status
        );
    }
}
