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
            'name'         => $name,
            'code'         => 'IDO' . rand(100, 999) . strtoupper($this->faker->lexify('??')),
            'address'      => $this->faker->streetAddress() . ', Bangkok ' . $this->faker->postcode() . ', Thailand',
            'phone_number' => '02-' . $this->faker->numberBetween(100, 999) . '-' . $this->faker->numberBetween(1000, 9999),
            'email'        => 'juristic.' . strtolower(str_replace([' ', '-'], '', explode(' ', $name)[1] ?? $this->faker->word())) . '@ideo.co.th',
            'line_id'      => '@ideo' . strtolower($this->faker->lexify('???')),
            'total_floors' => $this->faker->numberBetween(20, 50),
            'total_units'  => $this->faker->randomElement([200, 300, 400, 500, 600]),
            'built_year'   => $this->faker->numberBetween(2015, 2024),
        ];
    }
}
