<?php

namespace Database\Factories;

use App\Models\crews;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\crews>
 */
class crewsFactory extends Factory
{
    protected $model = crews::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [ 
            'name' => $this->faker->company, 
            'color' => $this->faker->safeColorName, 'slogan' => $this->faker->catchPhrase, 'capacity' => $this->faker->numberBetween(30, 100), 
            'foundation_date' => $this->faker->date, 
        ];
    }
}
