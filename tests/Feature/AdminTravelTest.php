<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Travel;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTravelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_update_travel_successfully(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name' , 'editor')->value('id'));
        $travel = Travel::factory()->create();
        $response = Travel::factory()->create();
        $response = $this->actingAs($user)->putJson('api/v1/travels/'.$travel->id, [
            'name' => 'Travel Name',
        ]);

        $response->assertStatus(422);
        $response = $this->actingAs($user)->putJson('api/v1/travels/'.$travel->id, [
           'name' => 'Travel name updated',
           'isPublic' => 1 ,
            'description' => 'Some description updated',
            'numberOfDays' => 5
        ]);
        $response->assertStatus(200);
        $response = $this->get('/api/v1/travels');
        $response->assertJsonFragment(['name' => 'Travel name updated']);
    }
}
