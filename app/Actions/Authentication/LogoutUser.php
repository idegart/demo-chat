<?php

namespace App\Actions\Authentication;

use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class LogoutUser
{
    use AsAction;

    public function handle(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('view.login');
    }
}
