<?php

declare(strict_types=1);

namespace Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestHelper;

class ApiUserCreateControllerTest extends TestCase
{
    use TestHelper;

    public function testApiCreateUserWithUsersProvider(): void
    {
        $this->init();

        $password_confirmation = $this->password;

        $response = $this->post(sprintf(
            '%s?name=%s&email=%s&password=%s&password_confirmation=%s',
            '/api/register/users',
            $this->name, $this->email, $this->password, $password_confirmation,
        ))->assertStatus(Response::HTTP_CREATED);

        $user = User::query()->latest();
        $this->assertEquals($user->value('name'), $this->name);
        $this->assertTrue(Auth::attempt(['email' => $this->email, 'password' => $this->password]));
        $this->assertNotNull($user->value('api_token'));
        $this->assertTrue((bool)$user->value('status'));

        $response->assertJson(fn (AssertableJson $json) =>
            $json->where('token', $user->value('api_token'))
                ->has('user', fn (AssertableJson $json) =>
                $json->where('id', $user->value('id'))
                    ->where('email', $this->email)
                    ->where('updated_at', (string)$user->value('updated_at'))
                    ->where('created_at', (string)$user->value('created_at'))
                )
            );
    }

    public function testFailCreateUser(): void
    {
        $this->init();

        $password_confirmation = Str::random(12);

        $this->post(sprintf(
            '%s?name=%s&email=%s&password=%s&password_confirmation=%s',
            route('api.register', 'users'),
            $this->name, $this->email, $this->password, $password_confirmation,
        ))->assertStatus(Response::HTTP_FOUND);
    }
}
