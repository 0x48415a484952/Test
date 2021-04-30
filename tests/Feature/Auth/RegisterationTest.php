<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterationTest extends TestCase
{
    use RefreshDatabase;

    private string $email = 'hazhir@mailhog.local';
    private string $password = '$3Cre7PaSsW0Rd';

    public function test_it_requires_an_email()
    {
        $this->json('POST', 'api/register')
            ->assertJsonValidationErrors('email');
    }

    public function test_it_requires_a_valid_email()
    {
        $this->json('POST', 'api/register', [
            'email' => 'test'
        ])->assertJsonValidationErrors('email');
    }

    public function test_it_requires_a_unique_email()
    {
        Notification::fake();
        
        $this->json('POST', 'api/register', [
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password
        ]);
        $this->json('POST', 'api/register', [
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password
        ])->assertJsonValidationErrors('email');
    }


    public function test_it_requires_a_password()
    {
        $this->json('POST', 'api/register')
            ->assertJsonValidationErrors('password');
    }

    public function test_it_requires_at_least_one_number_in_password()
    {
        $this->json('POST', 'api/register', [
            'password' => 'aaaaaaaaaaA+'
        ])
            ->assertJsonValidationErrors('password');
    }

    public function test_it_requires_at_least_one_lowercae_character_in_password()
    {
        $this->json('POST', 'api/register', [
            'password' => 'AAAAAAAAAAA1+'
        ])
            ->assertJsonValidationErrors('password');
    }

    public function test_it_requires_at_least_one_uppercase_character_in_password()
    {
        $this->json('POST', 'api/register', [
            'password' => 'aaaaaaaaaaa1+'
        ])
            ->assertJsonValidationErrors('password');
    }

    public function test_it_requires_at_least_one_special_character_in_password()
    {
        $this->json('POST', 'api/register', [
            'password' => 'aaaaaaaaaaaA1'
        ])
            ->assertJsonValidationErrors('password');
    }

    public function test_it_can_register_a_new_user()
    {
        Notification::fake();

        $this->json('POST', 'api/register', [
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password
        ])->assertJsonFragment([
            'email' => $this->email
        ]);
    }

    public function test_it_can_insert_the_registered_user_in_database()
    {
        $this->json('POST', 'api/register', [
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password
        ]);
    
        $this->assertDatabaseHas('users', ['email' => $this->email]);
    }
}
