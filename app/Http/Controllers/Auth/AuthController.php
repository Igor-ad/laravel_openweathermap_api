<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function store(UserCreateRequest $request): ?User
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    protected function login($oauth): ?User
    {
        return User::updateOrCreate(
            [
                'email' => $oauth->email,
            ],
            [
                'name' => $oauth->name,
                'first_name' => $oauth->user['given_name'],
                'last_name' => $oauth->user['family_name'],
                'email' => $oauth->email,
                'provider_id' => $oauth->id,
                'profile' => $oauth->avatar,
            ]
        );
    }
}
