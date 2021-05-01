<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    //refactor to use factories later
    use RefreshDatabase;

    private $loginUrl = 'api/auth/login';
    private $email = 'hazhir@mailhog.local';
    private $password = '$3Cre7PaSsW0Rd';
    public function test_it_reauires_an_email()
    {
        $this->json('Post', $this->loginUrl)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_reauires_a_password()
    {
        $this->json('Post', $this->loginUrl)
            ->assertJsonValidationErrors(['password']);
    }

    public function test_it_returns_a_validation_error_if_the_credentials_did_not_match()
    {
        $user = User::create([
            'email' => $this->email,
            'password' => $this->password
        ]);

        $this->json('Post', $this->loginUrl, [
            'email' => $user->email,
            'password' => 'passwordPasswordPassword'
        ])
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_returns_a_token_if_the_credentials_do_match()
    {
        $user = User::create([
            'email' => $this->email,
            'password' => $this->password
        ]);

        $this->json('Post', $this->loginUrl, [
            'email' => $user->email,
            'password' => $this->password
        ])
            ->assertJsonStructure([
                'meta' => [
                    'token',
                    'type'
                ]
            ]);
    }

    public function test_it_returns_a_user_if_the_credentials_do_match()
    {
        $user = User::create([
            'email' => $this->email,
            'password' => $this->password
        ]);
        $this->json('Post', $this->loginUrl, [
            'email' => $user->email,
            'password' => $this->password
        ])
            ->assertJsonFragment([
                'email' => $user->email
            ]);
    }
}
