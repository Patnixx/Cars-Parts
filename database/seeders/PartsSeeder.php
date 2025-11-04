<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Part;
use App\Models\Car;

class PartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 4; $i++) {
            Part::create([
                'name' => 'Chladič motora',
                'serial_number' => 'SN' . $i  . rand(1000, 9999),
                'car_id' => $i,
            ]);

            Part::create([
                'name' => 'Autobatéria',
                'serial_number' => 'SN' . $i . rand(1000, 9999),
                'car_id' => $i,
            ]);

            Part::create([
                'name' => 'Tesnenie pod hlavou',
                'serial_number' => 'SN' . $i . rand(1000, 9999),
                'car_id' => $i,
            ]);
        }
    }
}
