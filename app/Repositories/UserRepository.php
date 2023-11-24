<?php

declare(strict_types=1);

namespace App\Repositories;

use Laravel\Socialite\Contracts\User as SocUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create(array $validData): User
    {
        return User::create([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'password' => Hash::make($validData['password']),
        ]);
    }

    public function updateOrCreate(SocUser $socUser): User
    {
        return User::updateOrCreate(
            [
                'email' => $socUser->email,
            ],
            [
                'name' => $socUser->name,
                'first_name' => $socUser->user['given_name'],
                'last_name' => $socUser->user['family_name'],
                'email' => $socUser->email,
                'provider_id' => $socUser->id,
                'profile' => $socUser->avatar,
            ]
        );
    }
}
