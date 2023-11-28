<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Enums\ProviderEnum as Provider;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserCreateController extends Controller
{
    use AuthService;

    public function register(): View
    {
        return view('users.user_soc_register');
    }

    public function google(): RedirectResponse
    {
        return $this->redirectProvider(Provider::GOOGLE->value, false);
    }

    public function googleCallback(): RedirectResponse
    {
        $socUser = $this->callbackProvider(Provider::GOOGLE->value, false);
        $user = $this->login($socUser);
        Auth::login($user);

        return redirect()->route('web.home');
    }

    public function users(UserCreateRequest $request): RedirectResponse
    {
        $user = $this->store($request->validated());
        Auth::login($user);

        return redirect()->route('web.home');
    }
}
