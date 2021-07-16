<?php

namespace App\Http\Controllers;

use App\Actions\Chat\SendMessage;
use App\Http\Requests\Chat\SendMessageRequest;
use App\Models\Chat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ChatController extends Controller
{
    public function chat(Chat $chat)
    {
        $chat->load('messages.user');

        return view('pages.chat', compact('chat'));
    }

    public function sendMessage(SendMessageRequest $request, Chat $chat, SendMessage $sendMessage): RedirectResponse
    {
        return $sendMessage->handle($chat, $request->user(), $request->text());
    }
}
