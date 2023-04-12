<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndustryTypes as Industry;

class IndustryTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Industry::create([
            'name' => 'Advertising & Marketing',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Aerospace and Aviation',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Automobiles',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Agriculture',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Computer and  Technology ',
                'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Construction',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Education',
                'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Energy & Environment',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Engineering',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Entertainment',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Fashion & Showbiz',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Finance & Economic',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Food & Beverages',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Health Care',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Oil & Gas',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Manufacturing Chemicals',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Manufacturing',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Petrochemicals',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Media & Broad Casting',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Metals and Mining',
            'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Pharmaceutical',
                'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Telecommunication',
                'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Textiles & Garments',
                'is_active'=>1
        ]);
        Industry::create([
            'name' => 'Transportation',
                'is_active'=>1
        ]);  
    } 

}
