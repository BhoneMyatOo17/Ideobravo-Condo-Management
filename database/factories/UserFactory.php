<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('bhonemyatoo'),
            'remember_token'    => Str::random(10),
            'user_type'         => null,
            'userable_id'       => null,
            'userable_type'     => null,
            'condo_id'          => null,
            'phone_number'      => '0' . $this->faker->numberBetween(60, 99) . $this->faker->numberBetween(1000000, 9999999),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'user_type'     => 'admin',
            'userable_type' => null,
            'userable_id'   => null,
        ]);
    }
}
