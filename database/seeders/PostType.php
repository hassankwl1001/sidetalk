<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_type')->insert([
            'name' => 'Article'
        ]);

        DB::table('post_type')->insert([
            'name' => 'Photo'
        ]);

        DB::table('post_type')->insert([
            'name' => 'Video'
        ]);

        DB::table('post_type')->insert([
            'name' => 'Job'
        ]);

        DB::table('post_type')->insert([
            'name' => 'Shared'
        ]);
    }
}
