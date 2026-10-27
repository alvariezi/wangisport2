<?php

namespace Database\Factories;

use App\Models\Court;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory; /** * @extends Factory<Court> */
class CourtFactory extends Factory
{
    protected $model = Court::class;

    public function definition(): array
    {
        return ['tenant_id' => Tenant::factory(), 'name' => 'Lapangan '.fake()->unique()->word(), 'type' => fake()->randomElement(['futsal', 'badminton', 'basket', 'padel']), 'surface_type' => 'Rumput Sintetis', 'is_active' => true];
    }
}
