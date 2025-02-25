<?php

namespace Database\Seeders;

use App\Models\roles;
use App\Models\User;
use App\Models\crews;
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

        // crews::factory()->create([
        //     [ 
        //     'id' => 1, 
        //     'name' => 'Peña Los Amigos', 
        //     'color' => 'Rojo', 
        //     'slogan' => 'Amigos para siempre', 
        //     'capacity' => 50, 
        //     'foundation_date' => '2001-05-12', 
        // ], 
        //     [ 'id' => 2, 
        //     'name' => 'Peña Los Guerreros', 
        //     'color' => 'Azul', 
        //     'slogan' => 'Luchando juntos', 
        //     'capacity' => 75, 'foundation_date' => '1999-08-25', 
        // ], 
        //     [ 'id' => 3, 
        //     'name' => 'Peña La Unión', 
        //     'color' => 'Verde', 
        //     'slogan' => 'Unidos somos fuertes', 
        //     'capacity' => 60, 
        //     'foundation_date' => '2005-11-30', 
        // ], 
        //     [ 'id' => 4, 
        //     'name' => 'Peña Las Estrellas', 
        //     'color' => 'Amarillo', 
        //     'slogan' => 'Brillamos juntos', 
        //     'capacity' => 80, 
        //     'foundation_date' => '2000-03-18', 
        // ], 
        //     [ 'id' => 5, 
        //     'name' => 'Peña Los Valientes', 
        //     'color' => 'Naranja', 
        //     'slogan' => 'Valentía y honor', 
        //     'capacity' => 90, 
        //     'foundation_date' => '2010-06-21', 
        // ],
        // ]);

        $crews = [ 
            [ 'id' => 1, 'name' => 'Peña Los Amigos', 'color' => 'Rojo', 'slogan' => 'Amigos para siempre', 'capacity' => 50, 'foundation_date' => '2001-05-12','logo' => '/penyas/penya1.jpg' ], 
            [ 'id' => 2, 'name' => 'Peña Los Guerreros', 'color' => 'Azul', 'slogan' => 'Luchando juntos', 'capacity' => 75, 'foundation_date' => '1999-08-25','logo' => '/penyas/penya2.jpg' ], 
            [ 'id' => 3, 'name' => 'Peña La Unión', 'color' => 'Verde', 'slogan' => 'Unidos somos fuertes', 'capacity' => 60, 'foundation_date' => '2005-11-30','logo' => '/penyas/penya3.jpg' ], 
            [ 'id' => 4, 'name' => 'Peña Las Estrellas', 'color' => 'Amarillo', 'slogan' => 'Brillamos juntos', 'capacity' => 80, 'foundation_date' => '2000-03-18','logo' => '/penyas/penya4.jpg' ], 
            [ 'id' => 5, 'name' => 'Peña Los Valientes', 'color' => 'Naranja', 'slogan' => 'Valentía y honor', 'capacity' => 90, 'foundation_date' => '2010-06-21','logo' => '/penyas/penya5.jpg' ], ]; foreach ($crews as $crew) { Crews::factory()->create($crew); 
        }
        $this->call(LocationsSeeder::class);

    }
}
