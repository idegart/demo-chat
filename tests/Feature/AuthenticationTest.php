<?php

namespace Tests\Feature;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    use WithFaker;

    /** @test **/
    public function user_can_not_login_with_empty_credentials(): void
    {
        $this->post(route('login'))
            ->assertSessionHasErrors([
                'email',
                'password',
            ]);
    }

    /** @test **/
    public function user_can_not_login_with_bad_credentials(): void
    {
        $this->post(route('login'), [
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors([
                'password',
            ]);
    }

    /** @test **/
    public function user_can_login_with_correct_credentials(): void
    {
        User::factory()->create([
            'email' => $email = $this->faker->email,
            'password' => bcrypt($password = $this->faker->password),
        ]);

        $this->post(route('login'), [
            'email' => $email,
            'password' => $password,
        ])
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect(route('users'));
    }

    /** @test **/
    public function user_can_logout(): void
    {
        Auth::login(User::factory()->create());

        $this->assertTrue(Auth::check());

        $this->post(route('logout'));

        $this->assertFalse(Auth::check());
    }
}
