<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::truncate();

        Activity::create([
            'name' => 'Yoga',
            'capacity' => 23,
            'duration' => 60,
            'schedule' => '2022-01-03 22:29:02',
            'instructor_name' => 'Timothy Valdez'
        ]);

        Activity::create([
            'name' => 'Zumba',
            'capacity' => 21,
            'duration' => 45,
            'schedule' => '2022-01-01 22:29:02',
            'instructor_name' => 'Robert Gomez'
        ]);

        Activity::create([
            'name' => 'Gap',
            'capacity' => 15,
            'duration' => 90,
            'schedule' => '2022-01-02 22:29:02',
            'instructor_name' => 'Josh Waltz'
        ]);
    }
}
