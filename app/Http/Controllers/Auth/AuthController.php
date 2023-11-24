<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\User as SocUser;
use App\Models\User;
use App\Repositories\UserRepository;

class AuthController extends Controller
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
}
