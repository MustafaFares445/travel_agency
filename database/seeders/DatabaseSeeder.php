<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Tour;
use App\Models\Travel;
use Database\Factories\TourFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $admin = \App\Models\User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@gmail.com',
         ]);
        $admin->roles()->attach(Role::where(['name' => 'admin'])->value('id'));

        $admin = \App\Models\User::factory()->create([
            'name' => 'editor',
            'email' => 'editor@gmail.com',
        ]);
        $admin->roles()->attach(Role::where(['name' => 'editor'])->value('id'));

        Tour::factory(10)->create();
    }
}
