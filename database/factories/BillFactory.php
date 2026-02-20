<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
{
    public function definition(): array
    {
        $types = ['common_area', 'water', 'electricity', 'insurance', 'parking', 'other'];
        $type = fake()->randomElement($types);
        
        $amounts = [
            'common_area' => fake()->randomFloat(2, 2000, 5000),
            'water' => fake()->randomFloat(2, 100, 500),
            'electricity' => fake()->randomFloat(2, 500, 3000),
            'insurance' => fake()->randomFloat(2, 1000, 2000),
            'parking' => fake()->randomElement([500, 1000, 1500]),
            'other' => fake()->randomFloat(2, 200, 1000),
        ];

        $issueDate = fake()->dateTimeBetween('-2 months', 'now');
        $dueDate = (clone $issueDate)->modify('+15 days');
        
        $isPaid = fake()->boolean(60);

        return [
            'bill_number' => 'BILL-' . date('Y') . '-' . fake()->unique()->numberBetween(10000, 99999),
            'bill_type' => $type,
            'amount' => $amounts[$type],
            'issue_date' => $issueDate,
            'due_date' => $dueDate,
            'paid_date' => $isPaid ? fake()->dateTimeBetween($issueDate, 'now') : null,
            'status' => $isPaid ? 'paid' : (now() > $dueDate ? 'overdue' : 'pending'),
            'payment_method' => $isPaid ? fake()->randomElement(['Bank Transfer', 'QR Code', 'Cash', 'Credit Card']) : null,
            'payment_reference' => $isPaid ? strtoupper(fake()->bothify('REF-########')) : null,
            'payment_proof' => null,
            'payment_notes' => null,
            'payment_submitted_at' => null,
            'notes' => fake()->optional(0.2)->sentence(),
        ];
    }
}