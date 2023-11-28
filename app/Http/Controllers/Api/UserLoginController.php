<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserLoginController extends Controller
{
    use ApiAuth;

    public function __invoke(UserLoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();

            return $this->authResponse($user, Response::HTTP_OK);
        }
        return response()->json(
            ['error' => __('api.error.auth_fail')],
            Response::HTTP_UNAUTHORIZED,
        );
    }
}
