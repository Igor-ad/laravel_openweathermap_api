<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ProviderEnum as Provider;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

trait AuthService
{
    protected function getMethod(UserCreateRequest $request, string $provider): JsonResponse|RedirectResponse
    {
        if ($provider === Provider::USERS->value) {
            return $this->$provider($request);
        } else {
            return $this->$provider();
        }
    }

    public function provider(UserCreateRequest $request, string $provider): JsonResponse|RedirectResponse
    {
        return $this->getMethod($request, $provider);
    }
}
