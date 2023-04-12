<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company as companyName;

class Company extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        companyName::create([
            'name' => 'Palmolive',
            'is_active'=>1
        ]);
        companyName::create([
            'name' => 'P&G',
            'is_active'=>1
        ]);
        companyName::create([
            'name' => 'GeekyShows',
            'is_active'=>1
        ]);
        companyName::create([
            'name' => 'Dalda',
            'is_active'=>1
        ]);
    }
}
