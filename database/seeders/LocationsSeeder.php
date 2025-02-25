<?php

namespace Database\Seeders;

use App\Models\crews;
use App\Models\locations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $crews = crews::all(); // Obtener todas las crews existentes
        
        if ($crews->isEmpty()) {
            $this->command->info('No hay crews disponibles, asegúrate de ejecutar el seeder de Crews primero.');
            return;
        }

        $years = range(2015, 2024); // Rango de años de 2015 a 2024

        foreach ($years as $year) {
            foreach ($crews as $crew) {
                locations::create([
                    'x' => rand(0, 4),
                    'y' => rand(0, 4),
                    'crews_id' => $crew->id, // Asignar cada crew en cada año
                    'year' => $year,
                ]);
            }
        }
    }
}
