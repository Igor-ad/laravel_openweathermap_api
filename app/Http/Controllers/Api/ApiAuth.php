<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ResponseTrait;
use App\Models\User;
use Illuminate\Http\JsonResponse;

trait ApiAuth
{
    use ResponseTrait;

    protected function updateToken(?User $user): string
    {
        $token = $user->createToken('api_token')->plainTextToken;
        $user->timestamps = false;
        $user->update(['api_token' => $token]);

        return $token;
    }

    protected function authResponse(?User $user, int $status): JsonResponse
    {
        return $this->collectionResponse([
            'user' => $user,
            'token' => $this->updateToken($user),
        ],
            $status
        );
    }
}
