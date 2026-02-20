<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StaffFactory extends Factory
{
    public function definition(): array
    {
        $positions = [
            'Juristic Manager',
            'Assistant Manager',
            'Front Desk Officer',
            'Maintenance Supervisor',
            'Security Chief',
            'Cleaning Supervisor',
        ];

        $departments = [
            'Administration',
            'Maintenance',
            'Security',
            'Front Office',
            'Housekeeping',
        ];

        return [
            'position' => fake()->randomElement($positions),
            'department' => fake()->randomElement($departments),
            'employee_id' => 'EMP' . fake()->unique()->numberBetween(1000, 9999),
            'hire_date' => fake()->dateTimeBetween('-5 years', '-6 months'),
            'employment_type' => fake()->randomElement(['full-time', 'part-time', 'contract']),
            'work_phone' => '02-' . fake()->numberBetween(100, 999) . '-' . fake()->numberBetween(1000, 9999),
            'work_email' => fake()->unique()->userName() . '@ideo.co.th',
            'is_active' => true,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Staff $staff) {
            // Create the user with polymorphic relationship to this staff
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('ideo@1234'),
                'user_type' => 'staff',
                'phone_number' => fake()->phoneNumber(),
                'condo_id' => $staff->condominium_id,
                'userable_id' => $staff->id,
                'userable_type' => Staff::class,
            ]);
        });
    }
}