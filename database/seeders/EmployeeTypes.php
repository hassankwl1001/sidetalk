<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeTypes as Employee;

class EmployeeTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'Full-time and Part-time employees'
        ]);

        Employee::create([
            'name' => 'Casual Employees'
        ]);
        Employee::create([
            'name' => 'Fixed term and contract'
        ]);
        Employee::create([
            'name' => 'Apprentices and trainees'
        ]);
        Employee::create([
            'name' => 'Commission and piece rate employees'
        ]);
    }
}
