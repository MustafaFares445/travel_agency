<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Travel;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTourTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_public_user_cannot_access_adding_tour(): void
    {
        $travel = Travel::factory()->create();
        $response = $this->postJson("api/v1/admin/travels/'.$travel->id.'/tours");
        $response->assertStatus(401);
    }

    public function test_non_admin_user_cannot_access_adding_tour()
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name' , 'editor')->value('id'));
        $travel = Travel::factory()->create();
        $response = $this->actingAs($user)->postJson("api/v1/admin/travels/{$travel->id}/tours");
        $response->assertStatus(403);
    }

    public function test_add_tour_with_invalid_data_successfully()
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name' , 'admin')->value('id'));
        $travel = Travel::factory()->create();

        $response = $this->actingAs($user)->postJson("api/v1/admin/travels/{$travel->id}/tours", [
            'name' => 'Tour Name',
           'startingDate' => '2024-05-31',
            'endingDate' => '2024-06-01',
            'price' => 100,
        ]);

        $response->assertStatus(201);
        $response = $this->get("api/v1/travels/{$travel->slug}/tours");
        $response->assertJsonFragment(['name' => 'Tour Name']);
    }
}
