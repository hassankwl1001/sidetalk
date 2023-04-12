<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomField as Custom;

class CustomField extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Custom::create([
            'custom_field_type_id' => 1,
            'name' => 'BASE URL',
            'shortcode' => 'BASE_URL',
            'description' => 'http://localhost/'
        ]);

        Custom::create([
            'custom_field_type_id' => 1,
            'name' => 'Profile Pictures path',
            'shortcode' => 'PROFILE_PIC',
            'description' => 'skilledtalk/backend/storage/app/public/images/users/profile'
        ]);

        Custom::create([
            'custom_field_type_id' => 1,
            'name' => 'Files for posts',
            'shortcode' => 'POST_FILES',
            'description' => 'skilledtalk/backend/storage/app/public/images/users/posts'
        ]);
    }
}
