<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Enums\ProviderEnum as Provider;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class UserCreateController extends Controller
{
    use AuthService, ApiAuth;

    public function google(): RedirectResponse
    {
        return $this->redirectProvider(Provider::GOOGLE->value);
    }

    public function googleCallback(): JsonResponse
    {
        $socUser = $this->callbackProvider(Provider::GOOGLE->value);
        $user = $this->login($socUser);

        return $this->authResponse($user, Response::HTTP_CREATED);
    }

    public function users(UserCreateRequest $request): JsonResponse
    {
        $user = $this->store($request->validated());

        return $this->authResponse($user, Response::HTTP_CREATED);
    }
}
