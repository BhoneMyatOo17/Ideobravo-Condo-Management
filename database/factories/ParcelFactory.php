<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParcelFactory extends Factory
{
    public function definition(): array
    {
        $senders = [
            'Kerry Express',
            'Flash Express',
            'Thailand Post',
            'DHL',
            'Lazada',
            'Shopee',
            'JD Central',
        ];

        return [

            'picked_up_by' => null,
            'tracking_number' => strtoupper(fake()->unique()->bothify('??###??###??')),
            'recipient_name' => fake()->name(),
            'courier_service' => fake()->randomElement($senders),
            'parcel_size' => fake()->randomElement(['small', 'medium', 'large', 'extra_large']),
            'status' => fake()->randomElement(['pending', 'notified']),
            'received_date' => fake()->dateTimeBetween('-7 days', 'now'),
            'picked_up_date' => null,
            'notes' => fake()->optional(0.3)->sentence(),
            'image' => null,
        ];
    }
}