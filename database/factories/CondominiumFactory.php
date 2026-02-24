<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Condominium;

class CondominiumFactory extends Factory
{
    protected $model = Condominium::class;
    public function definition(): array
    {
        static $nameIndex = 0;

        $names = [
            'Ideo Q Sukhumvit 36',
            'Ideo Rama 9 - Asoke',
            'Ideo O2',
            'Ideo Sukhumvit 93',
            'Ideo Sukhumvit 115',
            'Ideo Mobi Sukhumvit',
            'Ideo Mobi Rama 9',
            'Ideo Blucove Sukhumvit',
        ];

        $name = $names[$nameIndex % count($names)];
        $nameIndex++;

        return [
            'name' => $name,
            'code' => 'IDO' . fake()->unique()->numberBetween(100, 999),
            'address' => fake()->streetAddress() . ', Bangkok ' . fake()->postcode() . ', Thailand',
            'phone_number' => '02-' . fake()->numberBetween(100, 999) . '-' . fake()->numberBetween(1000, 9999),
            'email' => 'juristic.' . strtolower(str_replace(' ', '', explode(' ', $name)[1] ?? fake()->word())) . '@ideo.co.th',
            'line_id' => '@ideo' . strtolower(fake()->lexify('???')),
            'total_floors' => fake()->numberBetween(20, 50),
            'total_units' => fake()->randomElement([200, 300, 400, 500, 600]),
            'built_year' => fake()->numberBetween(2015, 2024),
        ];
    }
}
