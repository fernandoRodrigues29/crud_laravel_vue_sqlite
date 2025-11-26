<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();
        
        $user->update(['name' => 'Jane Doe']);
        
        $this->assertEquals('Jane Doe', $user->fresh()->name);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();
        
        $user->delete();
        
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}