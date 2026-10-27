<?php

namespace Database\Factories;

use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; /** * @extends Factory<Venue> */
class VenueFactory extends Factory
{
    protected $model = Venue::class;

    public function definition(): array
    {
        $name = fake()->company().' Sports Center';

        return ['code' => 'VNU-'.strtoupper(fake()->unique()->bothify('???###')), 'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(100, 999), 'name' => $name, 'tax_rate' => 0.1000, 'service_fee_rate' => 0.0200, 'status' => 'active'];
    }
}
