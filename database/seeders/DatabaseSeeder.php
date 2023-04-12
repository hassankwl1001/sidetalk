<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(
            [
                EmployeeTypes::class,
                CustomFieldType::class,
                CustomField::class,
                PostPrivacy::class,
                PostType::class,
                CountrySeeder::class,
                IndustryTypes::class,
                JobTypes::class,
                Company::class
            ]);
    }
}
