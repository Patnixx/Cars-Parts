<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Car::create([
            'name' => 'VW Passat B6',
            'registration_number' => 'AA123XY',
            'is_registered' => 0,
        ]);

        Car::create([
            'name' => 'Audi A4 B8',
            'registration_number' => 'AA494YZ',
            'is_registered' => 1,
        ]);

        Car::create([
            'name' => 'VW Golf MK6',
            'registration_number' => 'PB969CD',
            'is_registered' => 1,
        ]);

        Car::create([
            'name' => 'Mazda 6',
            'registration_number' => 'BL777EF',
            'is_registered' => 0,
        ]);
    }
}
