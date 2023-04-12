<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostPrivacy extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_privacy')->insert([
            'name' => 'Public'
        ]);

        DB::table('post_privacy')->insert([
            'name' => 'Private'
        ]);

        DB::table('post_privacy')->insert([
            'name' => 'Friends'
        ]);
    }
}
