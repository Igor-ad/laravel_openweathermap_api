<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\UserCreateRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class UserCreateController extends AuthController
{
    use AuthService;

    public function register(): View
    {
        return view('users.user_soc_register');
    }

    public function google(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();
        $user = $this->login($googleUser);
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
