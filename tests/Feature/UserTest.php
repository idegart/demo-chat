<?php

namespace Tests\Feature;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    use WithFaker;

    /** @test **/
    public function user_can_initiate_chat_with_another_user(): void
    {
        /** @var User $authUser */
        $authUser = User::factory()->create();

        /** @var User $chatUser */
        $chatUser = User::factory()->create();

        Auth::login($authUser);

        $this->post(route('initiate-chat', $chatUser))
            ->assertRedirect();

        $this->assertDatabaseHas('chat_member', [
            'user_id' => $authUser->getKey(),
        ]);

        $this->assertDatabaseHas('chat_member', [
            'user_id' => $chatUser->getKey(),
        ]);
    }
}
