<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_users()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'name', 'email', 'created_at', 'updated_at']
                     ]
                 ]);
    }

    /** @test */
    public function it_can_create_a_user_via_api()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        $response = $this->postJson('/api/users', $userData);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data' => ['id', 'name', 'email', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
    }

    /** @test */
    public function it_can_show_a_specific_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'id' => $user->id,
                         'name' => $user->name,
                         'email' => $user->email
                     ]
                 ]);
    }

    /** @test */
    public function it_can_update_a_user_via_api()
    {
        $user = User::factory()->create();

        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com'
        ];

        $response = $this->putJson("/api/users/{$user->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'name' => 'Updated Name',
                         'email' => 'updated@example.com'
                     ]
                 ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name'
        ]);
    }

    /** @test */
    public function it_can_delete_a_user_via_api()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'User deleted successfully']);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function it_validates_required_fields_when_creating_user()
    {
        $response = $this->postJson('/api/users', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }
}