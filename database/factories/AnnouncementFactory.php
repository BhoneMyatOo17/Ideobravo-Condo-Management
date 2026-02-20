<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    public function definition(): array
    {
        $titles = [
            'Swimming Pool Maintenance Notice',
            'Elevator Maintenance Schedule',
            'Fire Drill Announcement',
            'Water Supply Interruption',
            'Community Event: New Year Party',
            'Parking Regulation Update',
            'Waste Management Guidelines',
            'Security System Upgrade',
        ];

        $startDate = fake()->dateTimeBetween('-1 month', '+1 week');
        $endDate = fake()->optional(0.7)->dateTimeBetween($startDate, '+2 months');

        return [
            'title' => fake()->randomElement($titles),
            'description' => fake()->paragraphs(3, true),
            'image' => null,
            'category' => fake()->randomElement(['important', 'event', 'maintenance', 'update', 'new', 'eco', 'security', 'community']),
            'priority' => fake()->randomElement(['normal', 'high', 'urgent']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'send_email' => fake()->boolean(30),
            'send_push' => fake()->boolean(40),
            'target_audience' => 'all',
        ];
    }
}