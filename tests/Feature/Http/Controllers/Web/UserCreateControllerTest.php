<?php

declare(strict_types=1);

namespace Http\Controllers\Web;

use App\Http\Controllers\Web\UserCreateController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Tests\TestHelper;

class UserCreateControllerTest extends TestCase
{
    use TestHelper;

    public function testRegistrationView(): void
    {
        $view = $this->get(route('register'))->assertStatus(Response::HTTP_OK);

        $view->assertSee(config('app.name'));
        $view->assertSee(__('web.user'));
        $view->assertSee(__('web.registration'));
        $view->assertSee(__('web.nav.login'));
        $view->assertSee(__('web.login_with_google'));
        $view->assertSee(__('web.forms.email'));
        $view->assertSee(__('web.forms.pass'));
        $view->assertSee(__('web.forms.pass_conf'));
        $view->assertSee(__('web.create_new_user'));
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

        $user = User::query()->latest();
        $this->assertEquals($user->value('name'), $this->name);
        $this->assertTrue(Auth::attempt(['email' => $this->email, 'password' => $this->password]));
        $this->assertTrue((bool)$user->value('status'));

        $response->assertStatus(302);
        $response->assertRedirectToRoute('web.home');
        $response->assertLocation(route('web.home'));
    }
}
