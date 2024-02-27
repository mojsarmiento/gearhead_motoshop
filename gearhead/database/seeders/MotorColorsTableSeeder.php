<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotorColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ['Red', 'Blue', 'Green', 'Yellow']; // Add more colors as needed

        foreach ($colors as $color) {
            MotorColor::create(['color' => $color]);
        }
    }
}
