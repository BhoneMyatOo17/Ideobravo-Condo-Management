<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resident;

class ResidentFactory extends Factory
{
    protected $model = Resident::class;

    public function definition(): array
    {
        return [
            'unit_number'                    => (string) $this->faker->numberBetween(101, 999),
            'floor'                          => (string) $this->faker->numberBetween(1, 50),
            'move_in_date'                   => $this->faker->dateTimeBetween('-3 years', '-1 month'),
            'move_out_date'                  => $this->faker->optional(0.1)->dateTimeBetween('now', '+2 years'),
            'residency_status'               => $this->faker->randomElement(['owner', 'tenant']),
            'emergency_contact_name'         => $this->faker->name(),
            'emergency_contact_phone'        => '0' . $this->faker->numberBetween(60, 99) . '-' . $this->faker->numberBetween(100, 999) . '-' . $this->faker->numberBetween(1000, 9999),
            'emergency_contact_relationship' => $this->faker->randomElement(['spouse', 'parent', 'sibling', 'friend', 'colleague']),
            'number_of_occupants'            => $this->faker->numberBetween(1, 4),
            'is_active'                      => true,
        ];
    }
}
