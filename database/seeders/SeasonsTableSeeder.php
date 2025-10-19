<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonsTableSeeder extends Seeder
{
    public function run()
    {
        Season::create(['name' => 'spring']);
        Season::create(['name' => 'summer']);
        Season::create(['name' => 'fall']);
        Season::create(['name' => 'winter']);
    }
}
