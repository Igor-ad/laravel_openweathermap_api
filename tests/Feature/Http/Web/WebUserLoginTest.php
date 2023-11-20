<?php

declare(strict_types=1);

namespace Http\Web;

use Tests\TestCase;
use Tests\TestHelper;

class WebUserLoginTest extends TestCase
{
    use TestHelper;

    public function testLoginView()
    {
        $view = $this->get(route('login'))->assertOk();

        $view->assertSee(__('web.login_with_google'));
        $view->assertSee(__('web.nav.login'));
        $view->assertSee(__('web.forms.email'));
        $view->assertSee(__('web.forms.pass'));
        $view->assertDontSee(__('web.forms.pass_conf'));
    }

    public function testLoginUser()
    {
        $this->userInit();

        $data = ['email' => $this->email, 'password' => $this->password];

        $response = $this->post(route('web.login'), $data);

        $this->assertAuthenticated();
        $response->assertStatus(302);
        $response->assertRedirectToRoute('web.home');
    }
}
