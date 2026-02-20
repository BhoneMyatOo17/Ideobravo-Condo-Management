<?php

namespace Database\Factories;

use App\Models\Resident;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('bhonemyatoo'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    // Create a Resident user
    public function resident(): static
    {
        return $this->afterCreating(function ($user) {
            $resident = Resident::factory()->create();
            
            $user->update([
                'name' => $resident->name,
                'email' => $resident->email,
                'user_type' => 'resident',
                'userable_type' => Resident::class,
                'userable_id' => $resident->id,
            ]);
        });
    }

    // Create a Staff user
    public function staff(): static
    {
        return $this->afterCreating(function ($user) {
            $staff = Staff::factory()->create();
            
            $user->update([
                'name' => $staff->name,
                'email' => $staff->email,
                'user_type' => 'staff',
                'userable_type' => Staff::class,
                'userable_id' => $staff->id,
            ]);
        });
    }

    // Create an Admin user (no userable relationship)
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => 'admin',
            'userable_type' => null,
            'userable_id' => null,
        ]);
    }
}