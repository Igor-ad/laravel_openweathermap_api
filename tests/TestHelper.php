<?php

declare(strict_types=1);

namespace Tests;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

trait TestHelper
{
    protected string $name;
    protected string $email;
    protected string $password;
    protected ?User $user = null;

    protected function init(): void
    {
        $this->name = fake()->name();
        $this->email = fake()->email;
        $this->password = Str::random(12);
    }

    protected function userInit(): void
    {
        $this->init();
        $this->setUser();
    }

    private function setUser(): void
    {
        $this->user = User::factory()->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }

    /**
     *  Clean testing database after complete future test
     *  instead of the slow "use RefreshDatabase" trait
     */
    public function __destruct()
    {
        $this->user->delete();
        unset($this->user);
    }
}
