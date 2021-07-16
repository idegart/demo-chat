<?php

namespace App\Http\Controllers;

use App\Actions\Chat\InitiateChat;
use App\Http\Requests\User\InitiateChatRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $users = User::query()->where($user->getKeyName(), '!=', $user->getKey())->get();

        return view('pages.users', compact('users'));
    }

    public function initiateChat(InitiateChatRequest $request, User $user, InitiateChat $initiateChat): RedirectResponse
    {
        return $initiateChat->handle(collect([Auth::user(), $user]));
    }
}
