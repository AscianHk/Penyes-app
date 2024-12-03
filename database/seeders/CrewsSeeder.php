<?php

namespace Database\Seeders;

use App\Models\crews;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        crews::table('users')->insert([
            
        ]);
    }
}
