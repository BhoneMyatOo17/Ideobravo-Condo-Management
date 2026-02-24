<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Condominium;
use Faker\Factory as FakerFactory;

class CondominiumFactory extends Factory
{
    protected $model = Condominium::class;

    public function definition(): array
    {
        static $nameIndex = 0;
        $faker = FakerFactory::create();

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
            'code'         => 'IDO' . $faker->unique()->numberBetween(100, 999),
            'address'      => $faker->streetAddress() . ', Bangkok ' . $faker->postcode() . ', Thailand',
            'phone_number' => '02-' . $faker->numberBetween(100, 999) . '-' . $faker->numberBetween(1000, 9999),
            'email'        => 'juristic.' . strtolower(str_replace([' ', '-'], '', explode(' ', $name)[1] ?? $faker->word())) . '@ideo.co.th',
            'line_id'      => '@ideo' . strtolower($faker->lexify('???')),
            'total_floors' => $faker->numberBetween(20, 50),
            'total_units'  => $faker->randomElement([200, 300, 400, 500, 600]),
            'built_year'   => $faker->numberBetween(2015, 2024),
        ];
    }
}
