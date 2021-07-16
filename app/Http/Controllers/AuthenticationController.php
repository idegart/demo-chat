<?php

namespace App\Http\Controllers;

use App\Actions\Authentication\LoginUser;
use App\Actions\Authentication\LogoutUser;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\LogoutRequest;
use Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request, LoginUser $loginUser): RedirectResponse
    {
        return $loginUser->handle($request);
    }

    public function logout(LogoutRequest $request, LogoutUser $logoutUser): RedirectResponse
    {
        return $logoutUser->handle($request);
    }
}
