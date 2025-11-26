<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }

    /** @test */
    public function user_cannot_login_with_incorrect_credentials()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'wrong-password'
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function authenticated_user_can_get_their_profile()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/user');

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $user->id,
                     'name' => $user->name,
                     'email' => $user->email
                 ]);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_protected_routes()
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(401);
    }
}