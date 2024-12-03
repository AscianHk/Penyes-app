<?php

namespace Database\Seeders;

use App\Models\roles;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            // 'name' => 'Test User',
            // 'email' => 'test@example.com',
            'id'=> 1,
            'roles_Id' => 1,
            'name' => 'Admin',
            'surname' =>'Admins',
            'email' => 'admin@admin',
            'password' => 'admin'
        ]);
        Roles::factory()->create([
            'id' => 1,
            'isAdmin' => true,
            'user_id' => 1,
            // 'date'=>'11-11-2024'
        ]);
    }
}
