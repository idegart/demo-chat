<?php

namespace App\Actions\Chat;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class SendMessage
{
    use AsAction;

    public function handle(Chat $chat, User $sender, string $text): RedirectResponse
    {
        $message = new Message();
        $message->chat()->associate($chat);
        $message->user()->associate($sender);
        $message->text = $text;

        $message->save();

        return redirect()->route('chat', $chat);
    }
}
