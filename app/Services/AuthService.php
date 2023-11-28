<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Laravel\Socialite\Contracts\User as SocUser;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

trait AuthService
{
    public function __construct(
        protected UserRepository $userRepository,
    )
    {
    }

    protected function store(array $validData): ?User
    {
        return $this->userRepository->create($validData);
    }

    protected function login(SocUser $socUser): ?User
    {
        return $this->userRepository->updateOrCreate($socUser);
    }

    public function redirectProvider(string $provider, bool $stateless = true): RedirectResponse
    {
        if ($stateless) {
            return Socialite::driver($provider)->stateless()->redirect();
        } else {
            return Socialite::driver($provider)->redirect();
        }
    }

    public function callbackProvider(string $provider, bool $stateless = true): SocUser
    {
        if ($stateless) {
            return Socialite::driver($provider)->stateless()->user();
        } else {
            return Socialite::driver($provider)->user();
        }
    }

    public function provider(UserCreateRequest $request, string $provider): JsonResponse|RedirectResponse
    {
        return $this->$provider($request);
    }
}
