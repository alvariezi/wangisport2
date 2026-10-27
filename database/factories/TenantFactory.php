<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; /** * @extends Factory<Tenant> */
class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        $name = fake()->company().' Arena';

        return ['venue_id' => Venue::factory(), 'code' => 'TNT-'.strtoupper(fake()->unique()->bothify('???###')), 'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(100, 999), 'display_name' => $name, 'status' => 'active'];
    }
}
