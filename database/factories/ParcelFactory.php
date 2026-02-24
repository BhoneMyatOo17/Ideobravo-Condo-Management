<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Parcel;

class ParcelFactory extends Factory
{
    protected $model = Parcel::class;

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
            'tracking_number'  => strtoupper($this->faker->unique()->bothify('??###??###??')),
            'recipient_name'   => $this->faker->name(),
            'courier_service'  => $this->faker->randomElement($senders),
            'parcel_size'      => $this->faker->randomElement(['small', 'medium', 'large', 'extra_large']),
            'status'           => $this->faker->randomElement(['pending', 'notified']),
            'received_date'    => $this->faker->dateTimeBetween('-7 days', 'now'),
            'picked_up_date'   => null,
            'picked_up_by'     => null,
            'notes'            => $this->faker->optional(0.3)->sentence(),
            'image'            => null,
        ];
    }
}
