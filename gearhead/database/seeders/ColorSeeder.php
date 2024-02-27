<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create(['name' => 'Red']);
        Color::create(['name' => 'Blue']);
        Color::create(['name' => 'Black']);
        Color::create(['name' => 'Gray']);

    }
}
