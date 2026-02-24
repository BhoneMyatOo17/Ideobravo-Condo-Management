<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Staff;

class StaffFactory extends Factory
{
    protected $model = Staff::class;

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
            'position'        => $this->faker->randomElement($positions),
            'department'      => $this->faker->randomElement($departments),
            'employee_id'     => 'EMP' . $this->faker->unique()->numberBetween(1000, 9999),
            'hire_date'       => $this->faker->dateTimeBetween('-5 years', '-6 months'),
            'employment_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract']),
            'work_phone'      => '02-' . $this->faker->numberBetween(100, 999) . '-' . $this->faker->numberBetween(1000, 9999),
            'work_email'      => $this->faker->unique()->userName() . '@ideo.co.th',
            'is_active'       => true,
        ];
    }
}
