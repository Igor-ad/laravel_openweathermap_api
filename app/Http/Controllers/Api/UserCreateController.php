<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Enums\ProviderEnum as Provider;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\UserCreateRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;

class UserCreateController extends AuthController
{
    use AuthService, ApiAuth;

    public function google(): RedirectResponse
    {
        return Socialite::driver(Provider::GOOGLE->value)->stateless()->redirect();
    }

    public function googleCallback(): JsonResponse
    {
        $googleUser = Socialite::driver(Provider::GOOGLE->value)->stateless()->user();
        $user = $this->login($googleUser);

        return $this->authResponse($user, Response::HTTP_CREATED);
    }

    public function users(UserCreateRequest $request): JsonResponse
    {
        $user = $this->store($request->validated());

        return $this->authResponse($user, Response::HTTP_CREATED);
    }
}
