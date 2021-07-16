<?php

namespace Tests\Feature;

use App\Models\Chat;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    use WithFaker;

    /** @test **/
    public function user_can_send_message(): void
    {
        /** @var Chat $chat */
        $chat = Chat::factory()->create();

        /** @var User $authUser */
        $authUser = User::factory()->create();

        /** @var User $chatUser */
        $chatUser = User::factory()->create();

        $chat->members()->attach([$authUser->getKey(), $chatUser->getKey()]);

        Auth::login($authUser);

        $this->postJson(route('send-message', $chat), [
            'text' => $this->faker->text
        ])
            ->assertRedirect(route('chat', $chat));

        $this->assertSame(1, $chat->messages()->count());
    }
}
