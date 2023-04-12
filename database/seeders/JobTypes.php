<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobTypes as Job;

class JobTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::create([
            'name' => '.net Developer',
            'is_active'=>1
        ]);
        Job::create([
            'name' => 'HR',
            'is_active'=>1
        ]);
        Job::create([
            'name' => 'Plumber',
            'is_active'=>1
        ]);
        Job::create([
            'name' => 'Software Engineer',
            'is_active'=>1
        ]);
        Job::create([
            'name' => 'Director',
            'is_active'=>1
        ]);
        Job::create([
            'name' => 'Assistant',
            'is_active'=>1
        ]);
    }
}
