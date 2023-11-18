<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserLoginController extends Controller
{
    public function loginView(): View
    {
        return view('users.user_soc_login');
    }

    public function login(UserLoginRequest $request): RedirectResponse
    {
        $validate = $request->validated();

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();

            return redirect(route('web.home'));
        }
        return redirect()->intended(route('register'));
    }

    public function logout(Request $request): View
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('users.user_soc_login');
    }
}
