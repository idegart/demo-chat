<?php

namespace App\Actions\Chat;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;
use RuntimeException;

class InitiateChat
{
    use AsAction;

    /** @var Collection */
    private $users;

    public function handle(Collection $users): RedirectResponse
    {
        $this->users = $users;

        if (!$this->checkForUniqueUsers()) {
            throw new RuntimeException('Users must be unique');
        }

        $chat = $this->findCurrentChat();

        if (!$chat) {
            $chat = $this->createNewChat();
        }

        return redirect()->route('chat', $chat);
    }

    private function checkForUniqueUsers(): bool
    {
        $ids = $this->users->pluck('id');

        return $ids->count() === $ids->unique()->count();
    }

    private function findCurrentChat(): ?Chat
    {
        $chatQuery = Chat::query();

        $this->users->each(function (User $user) use ($chatQuery) {
            $chatQuery->whereHas('members', function (Builder $query) use ($user) {
                $query
                    ->selectRaw(1)
                    ->where('users.id', $user->getKey());
            });
        });

        return $chatQuery->first();
    }

    private function createNewChat(): Chat
    {
        $chat = new Chat();
        $chat->save();

        $this->users->each(function (User $user) use ($chat) {
            $chat->members()->attach($user);
        });


        return $chat;
    }
}
