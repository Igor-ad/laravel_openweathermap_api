<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

trait AuthService
{
    public function provider(UserCreateRequest $request, string $provider): JsonResponse|RedirectResponse
    {
        return $this->$provider($request);
    }
}
