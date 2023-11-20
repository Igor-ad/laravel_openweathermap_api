<?php

declare(strict_types=1);

namespace Http\Controllers;

use App\Enums\UserStatusEnum;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Tests\TestHelper;

class WeatherControllerTest extends TestCase
{
    use TestHelper;

    public function testGetWeather(): void
    {
        $this->userInit();

        $response = $this->actingAs($this->user, 'web')
            ->get('/home');

        $user = User::where('email', $this->email)->first();

        $response->assertStatus(200);

        $response->assertJson(
            fn(AssertableJson $json) =>
            $json
                ->has('user', fn(AssertableJson $json) =>
                $json
                    ->where('id', $user->getAttribute('id'))
                    ->where('first_name', $user->getAttribute('first_name'))
                    ->where('last_name', $user->getAttribute('last_name'))
                    ->where('email', $this->email)
                    ->where('profile', $user->getAttribute('profile'))
                    ->where('status', UserStatusEnum::TRUE->value)
                    ->has('created_at')
                    ->has('updated_at')
                )
                ->has('main', fn(AssertableJson $json) =>
                $json
                    ->has('temp')
                    ->has('temp_min')
                    ->has('temp_max')
                    ->has('pressure')
                    ->has('humidity')
                )
        );
    }
}
