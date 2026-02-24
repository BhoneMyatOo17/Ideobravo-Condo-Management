<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Announcement;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

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

        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 week');
        $endDate   = $this->faker->optional(0.7)->dateTimeBetween($startDate, '+2 months');

        return [
            'title'           => $this->faker->randomElement($titles),
            'description'     => $this->faker->paragraphs(3, true),
            'image'           => null,
            'category'        => $this->faker->randomElement(['important', 'event', 'maintenance', 'update', 'new', 'eco', 'security', 'community']),
            'priority'        => $this->faker->randomElement(['normal', 'high', 'urgent']),
            'start_date'      => $startDate,
            'end_date'        => $endDate,
            'send_email'      => $this->faker->boolean(30),
            'send_push'       => $this->faker->boolean(40),
            'target_audience' => 'all',
        ];
    }
}
