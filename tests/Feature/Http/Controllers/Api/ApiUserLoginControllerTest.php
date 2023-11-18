<?php

declare(strict_types=1);

namespace Http\Controllers\Api;

use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\TestHelper;

class ApiUserLoginControllerTest extends TestCase
{
    use TestHelper;

    public function testLoginUser(): void
    {
        $this->userInit();

        $response = $this->post(sprintf(
            '%s?email=%s&password=%s',
            '/api/login',
            $this->email, $this->password,
        ));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('users', $this->user->getAttributes());
        $this->assertNotNull($response['token']);

        $user = User::query()->latest();

        $response->assertJson(fn (AssertableJson $json) =>
        $json->where('token', $user->value('api_token'))
            ->has('user', fn (AssertableJson $json) =>
            $json->where('id', $user->value('id'))
                ->has('first_name')
                ->has('last_name')
                ->where('email', $this->email)
                ->has('profile')
                ->where('status', UserStatusEnum::TRUE->value)
                ->where('updated_at', (string)$user->value('updated_at'))
                ->where('created_at', (string)$user->value('created_at'))
            )
        );
    }

    public function testFailLoginUser(): void
    {
        $this->userInit();

        $response = $this->post(sprintf(
            '%s?email=%s&password=%s',
            '/api/login',
            $this->email, '**********',
        ));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $response->assertJsonPath('error', 'Login failure');
    }
}
