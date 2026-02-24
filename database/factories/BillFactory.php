<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bill;

class BillFactory extends Factory
{
    protected $model = Bill::class;

    public function definition(): array
    {
        $types = ['common_area', 'water', 'electricity', 'insurance', 'parking', 'other'];
        $type  = $this->faker->randomElement($types);

        $amounts = [
            'common_area' => $this->faker->randomFloat(2, 2000, 5000),
            'water'       => $this->faker->randomFloat(2, 100, 500),
            'electricity' => $this->faker->randomFloat(2, 500, 3000),
            'insurance'   => $this->faker->randomFloat(2, 1000, 2000),
            'parking'     => $this->faker->randomElement([500, 1000, 1500]),
            'other'       => $this->faker->randomFloat(2, 200, 1000),
        ];

        $issueDate = $this->faker->dateTimeBetween('-2 months', 'now');
        $dueDate   = (clone $issueDate)->modify('+15 days');
        $isPaid    = $this->faker->boolean(60);

        return [
            'bill_number'          => 'BILL-' . date('Y') . '-' . $this->faker->unique()->numberBetween(10000, 99999),
            'bill_type'            => $type,
            'amount'               => $amounts[$type],
            'issue_date'           => $issueDate,
            'due_date'             => $dueDate,
            'paid_date'            => $isPaid ? $this->faker->dateTimeBetween($issueDate, 'now') : null,
            'status'               => $isPaid ? 'paid' : (now() > $dueDate ? 'overdue' : 'pending'),
            'payment_method'       => $isPaid ? $this->faker->randomElement(['Bank Transfer', 'QR Code', 'Cash', 'Credit Card']) : null,
            'payment_reference'    => $isPaid ? strtoupper($this->faker->bothify('REF-########')) : null,
            'payment_proof'        => null,
            'payment_notes'        => null,
            'payment_submitted_at' => null,
            'notes'                => $this->faker->optional(0.2)->sentence(),
        ];
    }
}
