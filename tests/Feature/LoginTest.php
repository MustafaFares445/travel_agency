<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_login_returns_token_with_valid_credentials(): void
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/v1/login' , [
           'email' => $user->email,
           'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token']);
    }

    public function test_login_returns_error_with_invalid_credentials(): void
    {
        $response = $this->postJson('/api/v1/login' , [
           'email' => 'noexistingemail@gmai.com',
           'password' => 'password' ,
        ]);

        $response->assertStatus(422);
    }

    public function test_non_admin_user_cannot_access_adding_travel()
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name' , 'editor')->value('id'));
        $response = $this->actingAs($user)->postJson('/api/v1/admin/travels');

        $response->assertStatus(403);

    }
}
