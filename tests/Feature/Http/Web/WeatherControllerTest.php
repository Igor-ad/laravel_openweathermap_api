<?php

declare(strict_types=1);

namespace Http\Web;

use App\Models\User;
use Tests\TestCase;
use Tests\TestHelper;

class WeatherControllerTest extends TestCase
{
    use TestHelper;

    public function testGetWeather(): void
    {
        $this->userInit();

        $view = $this->actingAs($this->user, 'web')
            ->get(route('web.home'))->assertOk();

        $view->assertSee( __('web.current_forecast'));
        $view->assertSee(  $this->user->getAttribute('id'));
        $view->assertSee(  $this->user->getAttribute('email'));
        $view->assertSee( 'main');
    }
}
