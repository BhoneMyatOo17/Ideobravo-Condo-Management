<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ResidentFactory extends Factory
{
    public function definition(): array
    {
        return [
            
            'unit_number' => fake()->numberBetween(101, 999),
            'floor' => (string) fake()->numberBetween(1, 50),
            'move_in_date' => fake()->dateTimeBetween('-3 years', '-1 month'),
            'move_out_date' => fake()->optional(0.1)->dateTimeBetween('now', '+2 years'),
            'residency_status' => fake()->randomElement(['owner', 'tenant']),
            'emergency_contact_name' => fake()->name(),
            'emergency_contact_phone' => '0' . fake()->numberBetween(60, 99) . '-' . fake()->numberBetween(100, 999) . '-' . fake()->numberBetween(1000, 9999),
            'emergency_contact_relationship' => fake()->randomElement(['spouse', 'parent', 'sibling', 'friend', 'colleague']),
            'number_of_occupants' => fake()->numberBetween(1, 4),
            'is_active' => true,
        ];
    }
}