<?php

declare(strict_types=1);

namespace Http\Web;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\TestHelper;

class WebUserCreateTest extends TestCase
{
    use TestHelper;

    public function testRegistrationView(): void
    {
        $view = $this->get(route('register'))->assertOk();

        $view->assertSee(__('web.registration'));
        $view->assertSee(__('web.login_with_google'));
        $view->assertSee(__('web.forms.pass_conf'));
    }

    public function testWebCreateUserWithUsersProvider(): void
    {
        $this->init();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password,
        ];

        $response = $this->post(route('web.register', 'users'), $data);
        $this->user = User::where('email', $this->email)->first();

        $this->assertEquals($this->user->getAttribute('name'), $this->name);
        $this->assertEquals($this->user->getAttribute('email'), $this->email);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirectToRoute('web.home');
        $response->assertLocation(route('web.home'));
    }
}
