<?php

namespace App\Actions\Authentication;

use App\Contracts\Authentication\LoginUserData;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\RedirectResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginUser
{
    use AsAction;

    public function handle(LoginUserData $data): RedirectResponse
    {
        /** @var User|null $user */
        $user = User::query()->where('email', $data->login())->first();

        if ($user && Hash::check($data->password(), $user->getAuthPassword())) {
            Auth::login($user);
            return redirect()->to(route('users'));
        }

        return redirect()->to(route('login'))->withErrors([
            'password' => __('auth.failed')
        ]);
    }
}
