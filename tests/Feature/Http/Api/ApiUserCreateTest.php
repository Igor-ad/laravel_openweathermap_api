<?php

declare(strict_types=1);

namespace Http\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\TestHelper;

class ApiUserCreateTest extends TestCase
{
    use TestHelper;

    public function testApiCreateUserWithUsersProvider(): void
    {
        $this->init();

        $password_confirmation = $this->password;

        $response = $this->post(sprintf(
            '%s?name=%s&email=%s&password=%s&password_confirmation=%s',
            '/api/register/users',
            $this->name,
            $this->email,
            $this->password,
            $password_confirmation,
        ))->assertStatus(Response::HTTP_CREATED);

        $this->user = User::where('email', $this->email)->first();


        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('token', $this->user->getAttribute('api_token'))
                ->has('user', fn (AssertableJson $json) =>
                $json->where('id', $this->user->getAttribute('id'))
                    ->where('name', $this->name)
                    ->where('email', $this->email)
                    ->where('updated_at', (string)$this->user->getAttribute('updated_at'))
                    ->where('created_at', (string)$this->user->getAttribute('created_at'))));
    }

    public function testFailCreateUser(): void
    {
        $this->init();

        $password_confirmation = Str::random(12);

        $this->post(sprintf(
            '%s?name=%s&email=%s&password=%s&password_confirmation=%s',
            route('api.register', 'users'),
            $this->name,
            $this->email,
            $this->password,
            $password_confirmation,
        ))->assertStatus(Response::HTTP_FOUND);
    }
}
